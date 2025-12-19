<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function index()
    {

        return view('admin.dashboard');
    }
}
