<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\PagesController;

class ConvertAdminTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:convert-template 
                            {staticPath : Path to the static HTML file (relative to public directory)}
                            {bladePath : Path where to save the Blade file (relative to resources/views)}
                            {--t|title= : Page title to use in the Blade view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert a static HTML template to a Blade view';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $staticPath = $this->argument('staticPath');
        $bladePath = $this->argument('bladePath');
        $title = $this->option('title') ?? 'Admin Dashboard';
        
        $this->info("Converting {$staticPath} to Blade view at {$bladePath}...");
        
        // Custom replacements
        $replacements = [];
        
        if ($title) {
            $replacements['<title>.*?</title>'] = '@section(\'title\', \'' . $title . '\')';
        }
        
        // Use the PagesController to handle the conversion
        $pagesController = new PagesController();
        $result = $pagesController->convertStaticToBladeView($staticPath, $bladePath, $replacements);
        
        if ($result) {
            $this->info("✓ Successfully converted {$staticPath} to {$bladePath}.blade.php");
        } else {
            $this->error("✗ Failed to convert {$staticPath}. Make sure the file exists and is accessible.");
        }
    }
    
    /**
     * Convert all available templates.
     */
    public static function convertAll()
    {
        $command = new self();
        
        // Define templates to convert
        $templates = [
            // UI Features
            ['Admin/pages/ui-features/buttons.html', 'admin.pages.ui-features.buttons', 'Buttons - Admin Dashboard'],
            ['Admin/pages/ui-features/dropdowns.html', 'admin.pages.ui-features.dropdowns', 'Dropdowns - Admin Dashboard'],
            ['Admin/pages/ui-features/typography.html', 'admin.pages.ui-features.typography', 'Typography - Admin Dashboard'],
            
            // Forms
            ['Admin/pages/forms/basic_elements.html', 'admin.pages.forms.basic_elements', 'Form Elements - Admin Dashboard'],
            
            // Tables
            ['Admin/pages/tables/basic-table.html', 'admin.pages.tables.basic-table', 'Basic Table - Admin Dashboard'],
            
            // Charts
            ['Admin/pages/charts/chartjs.html', 'admin.pages.charts.chartjs', 'ChartJS - Admin Dashboard'],
            
            // Icons
            ['Admin/pages/icons/mdi.html', 'admin.pages.icons.mdi', 'Material Design Icons - Admin Dashboard'],
            
            // Samples
            ['Admin/pages/samples/blank-page.html', 'admin.pages.samples.blank-page', 'Blank Page - Admin Dashboard'],
            ['Admin/pages/samples/error-404.html', 'admin.pages.samples.error-404', '404 Page - Admin Dashboard'],
            ['Admin/pages/samples/error-500.html', 'admin.pages.samples.error-500', '500 Page - Admin Dashboard'],
            ['Admin/pages/samples/login.html', 'admin.pages.samples.login', 'Login - Admin Dashboard'],
            ['Admin/pages/samples/register.html', 'admin.pages.samples.register', 'Register - Admin Dashboard'],
        ];
        
        $pagesController = new PagesController();
        
        foreach ($templates as [$staticPath, $bladePath, $title]) {
            // Convert dot notation to directory path
            $bladePathConverted = str_replace('.', '/', $bladePath);
            
            $command->info("Converting {$staticPath} to {$bladePathConverted}...");
            
            $replacements = [];
            if ($title) {
                $replacements['<title>.*?</title>'] = '@section(\'title\', \'' . $title . '\')';
            }
            
            $result = $pagesController->convertStaticToBladeView($staticPath, $bladePathConverted, $replacements);
            
            if ($result) {
                $command->info("✓ Successfully converted {$staticPath} to {$bladePathConverted}.blade.php");
            } else {
                $command->error("✗ Failed to convert {$staticPath}. Make sure the file exists and is accessible.");
            }
        }
        
        $command->info('All templates converted successfully!');
    }
}
