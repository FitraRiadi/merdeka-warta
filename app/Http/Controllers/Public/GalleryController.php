<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\RunningText;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(12);

        $runningTexts = RunningText::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('public.gallery-list', compact('galleries', 'runningTexts'));
    }
}
