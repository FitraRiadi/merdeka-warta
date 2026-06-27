<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\RunningText;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::paginate(12);

        $runningTexts = RunningText::latest()
            ->get();

        return view('public.gallery-list', compact('galleries', 'runningTexts'));
    }
}
