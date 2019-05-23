<?php

namespace App\Http\Controllers;

use App\VrGallery;
use Illuminate\Http\Request;

class VrGalleryController extends Controller
{
    public function index()
    {
        $vr_gallery = VrGallery::all()
            ->where('is_active', 1);
        return view('vr-gallery.index', ['vr_gallery' => $vr_gallery]);
    }
}