<?php

namespace App\Http\Controllers\Front;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact.index');
    }
}
