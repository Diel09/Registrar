<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('generate-barcode'); // Assuming 'generate-barcode' is the name of your Vue component file
    }
}
