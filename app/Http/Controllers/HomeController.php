<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $locale = App::getLocale(); 
        return view('home.index');
    }
}
