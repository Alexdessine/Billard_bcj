<?php

namespace App\Http\Controllers;

use App\Models\Gallerie;
use Illuminate\Http\Request;

class GallerieController extends Controller
{
    //
    public function index()
    {

        return view('gallerie', [
            'galleries' => Gallerie::paginate(6),
        ]);
    }
}
