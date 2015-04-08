<?php namespace Modules\Message\Http\Controllers;

use Illuminate\Routing\Controller;

class MessageController extends Controller
{

    /**
     * Render thread overview and open most recent thread
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('message::index');
    }

}
