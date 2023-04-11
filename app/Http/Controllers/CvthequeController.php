<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvthequeController extends Controller
{
    public function index()
    {
        $data = ['search' => ''];
        return view('cvtheque', $data);
    }
}
