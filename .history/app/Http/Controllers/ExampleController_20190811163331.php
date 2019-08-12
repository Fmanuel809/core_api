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

    public function getImage($filename)
    {
       $path = ('/img/products/'.$filename.'jpg');
       $file = Storage::get($path);
       $type = Storage::mimeType($path);

       return response($file, 200, ['Content-Type' => $type]);
    }
}
