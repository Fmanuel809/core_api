<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getImage($fileName)
    {
        return app('url')->asset('storage');

       //$response = Response::make($file, 200);
       //$response->header("Content-Type", $type);
       //return response()->json(['image' => $path], 200);
    }
}
