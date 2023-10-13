<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentionsController extends Controller
{
    public function index()
    {
        return view('pages.mentions');
    }
}
