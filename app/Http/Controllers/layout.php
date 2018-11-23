<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class layout extends Controller
{
    public function adminPanel() 
    {
    	return view('admin');
    }
}
