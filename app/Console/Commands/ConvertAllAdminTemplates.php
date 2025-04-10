<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertAllAdminTemplates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:convert-all-templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all admin HTML templates to Blade views';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting conversion of all admin templates...');
        
        // Use the ConvertAdminTemplate command to handle the conversion of all templates
        ConvertAdminTemplate::convertAll();
        
        $this->info('All admin templates converted successfully!');
    }
}
