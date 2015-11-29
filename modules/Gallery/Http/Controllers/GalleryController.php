<?php namespace Modules\Gallery\Http\Controllers;

use Modules\Gallery\Entities\Photo;
use Pingpong\Modules\Routing\Controller;

class GalleryController extends Controller {

    public function index()
    {
        $photos = Photo::with('category', 'contents', 'user')->get();

        return view('gallery::index', ['photos' => $photos]);
    }

}