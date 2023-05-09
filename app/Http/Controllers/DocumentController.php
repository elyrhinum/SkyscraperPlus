<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // METHOD TO REDIRECT TO INDEX PAGE
    public function index()
    {
        return view('documents.index', ['documents' => Document::orderBy('name', 'asc')->get()]);
    }

}
