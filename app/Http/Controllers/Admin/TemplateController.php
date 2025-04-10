<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    public function dashboard()
    {
        return view('admin.template.dashboard');
    }
    
    public function buttons()
    {
        return view('admin.template.buttons');
    }
    
    public function dropdowns()
    {
        return view('admin.template.dropdowns');
    }
    
    public function typography()
    {
        return view('admin.template.typography');
    }
    
    public function formElements()
    {
        return view('admin.template.form_elements');
    }
    
    public function tables()
    {
        return view('admin.template.tables');
    }
    
    public function charts()
    {
        return view('admin.template.charts');
    }
    
    public function icons()
    {
        return view('admin.template.icons');
    }
    
    public function blankPage()
    {
        return view('admin.template.blank');
    }
    
    public function error404()
    {
        return view('admin.template.404');
    }
    
    public function error500()
    {
        return view('admin.template.500');
    }
    
    public function documentation()
    {
        return view('admin.template.documentation');
    }
}
