<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontsiteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function dashboard()
    {
        return view('frontsite.dashboard');
    }
}