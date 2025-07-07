<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    //
    public function index()
    {
        return view('layouts.footer' , [
            'contact_footer' => SiteSetting::first(), 
        ]);
    }
}
