<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        return view('guru/home');
    }
}
