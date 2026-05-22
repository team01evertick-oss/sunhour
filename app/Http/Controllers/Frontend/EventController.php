<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class EventController extends Controller
{

    public function index()
    {
        return view('frontends.eventPage.index');
    }

    public function show($slug)
    {
        return view('frontends.eventPage.show', compact('slug'));
    }
}