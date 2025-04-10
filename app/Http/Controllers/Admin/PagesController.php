<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    /**
     * Display the dashboard page
     */
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    
    /**
     * UI Features Pages
     */
    public function buttons()
    {
        return view('admin.pages.ui-features.buttons');
    }
    
    public function dropdowns()
    {
        return view('admin.pages.ui-features.dropdowns');
    }
    
    public function typography()
    {
        return view('admin.pages.ui-features.typography');
    }
    
    /**
     * Form Pages
     */
    public function basicElements()
    {
        return view('admin.pages.forms.basic_elements');
    }
    
    /**
     * Table Pages
     */
    public function basicTable()
    {
        return view('admin.pages.tables.basic-table');
    }
    
    /**
     * Chart Pages
     */
    public function chartjs()
    {
        return view('admin.pages.charts.chartjs');
    }
    
    /**
     * Icon Pages
     */
    public function mdi()
    {
        return view('admin.pages.icons.mdi');
    }
    
    /**
     * Sample Pages
     */
    public function blankPage()
    {
        return view('admin.pages.samples.blank-page');
    }
    
    public function error404()
    {
        return view('admin.pages.samples.error-404');
    }
    
    public function error500()
    {
        return view('admin.pages.samples.error-500');
    }
    
    public function login()
    {
        return view('admin.pages.samples.login');
    }
    
    public function register()
    {
        return view('admin.pages.samples.register');
    }
    
    /**
     * Utility method to convert a static HTML template to a Blade view
     * This can be called from artisan commands or other methods
     * 
     * @param string $staticPath Path to the static HTML file
     * @param string $bladePath Path to the Blade file (relative to resources/views)
     * @param array $replacements Custom replacements to make in the HTML
     * @return bool
     */
    public function convertStaticToBladeView($staticPath, $bladePath, $replacements = [])
    {
        try {
            // Ensure the static file exists
            if (!File::exists(public_path($staticPath))) {
                return false;
            }
            
            // Read the HTML content
            $htmlContent = File::get(public_path($staticPath));
            
            // Default replacements to make the static HTML into a Blade view
            $defaultReplacements = [
                '<!DOCTYPE html>' => '@extends(\'admin.layouts.corona\')',
                '<html lang="en">' => '',
                '</html>' => '',
                '<head>' => '@section(\'content\')',
                '</head>' => '',
                '<body>' => '',
                '</body>' => '@endsection',
                // Fix asset paths
                '="../../assets/' => '="{{ asset(\'Admin/assets/',
                '="../assets/' => '="{{ asset(\'Admin/assets/',
                '="assets/' => '="{{ asset(\'Admin/assets/',
                '.css"' => '.css\') }}"',
                '.js"' => '.js\') }}"',
                '.png"' => '.png\') }}"',
                '.jpg"' => '.jpg\') }}"',
                '.svg"' => '.svg\') }}"',
                // Fix navigation links
                'href="../../index.html"' => 'href="{{ route(\'admin.corona\') }}"',
                'href="../index.html"' => 'href="{{ route(\'admin.corona\') }}"',
                'href="index.html"' => 'href="{{ route(\'admin.corona\') }}"',
                // Remove sidebars and navbars since they're included in the layout
                '<!-- partial:../../partials/_sidebar.html -->' => '<!-- Sidebar included in layout -->',
                '<!-- partial:../../partials/_navbar.html -->' => '<!-- Navbar included in layout -->',
                '<!-- partial:../partials/_sidebar.html -->' => '<!-- Sidebar included in layout -->',
                '<!-- partial:../partials/_navbar.html -->' => '<!-- Navbar included in layout -->',
                '<!-- partial:partials/_sidebar.html -->' => '<!-- Sidebar included in layout -->',
                '<!-- partial:partials/_navbar.html -->' => '<!-- Navbar included in layout -->',
                '<nav class="sidebar sidebar-offcanvas" id="sidebar">*</nav>' => '<!-- Sidebar included in layout -->',
                '<nav class="navbar p-0 fixed-top d-flex flex-row">*</nav>' => '<!-- Navbar included in layout -->',
            ];
            
            // Merge custom replacements with defaults
            $allReplacements = array_merge($defaultReplacements, $replacements);
            
            // Apply all replacements
            foreach ($allReplacements as $search => $replace) {
                if (strpos($search, '*') !== false) {
                    // Handle wildcard replacements using regex
                    $pattern = '/' . str_replace('*', '(.|\s)*?', preg_quote($search, '/')) . '/';
                    $htmlContent = preg_replace($pattern, $replace, $htmlContent);
                } else {
                    $htmlContent = str_replace($search, $replace, $htmlContent);
                }
            }
            
            // Clean up the content - remove empty lines and unnecessary HTML
            $htmlContent = preg_replace('/<title>.*?<\/title>/', '@section(\'title\', \'Admin Dashboard\')', $htmlContent);
            $htmlContent = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $htmlContent);
            
            // Ensure the directory exists
            $dirPath = resource_path('views/' . dirname($bladePath));
            if (!File::exists($dirPath)) {
                File::makeDirectory($dirPath, 0755, true);
            }
            
            // Write the content to the blade file
            File::put(resource_path('views/' . $bladePath . '.blade.php'), $htmlContent);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Error converting static HTML to Blade: ' . $e->getMessage());
            return false;
        }
    }
}
