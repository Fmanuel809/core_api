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

    public function getImage()
    {
       //$prueba = Storage::get('/img/products/i7.jpg');
       //var_dump(Storage::files('img/products/'));
       $path = ('/img/products/i7.jpg');
       $file = Storage::get($path);
       $type = Storage::mimeType($path);

       //$response = Response::make($file, 200);
       //$response->header("Content-Type", $type);
       return response()->json(['image' => $path], 200);
    }
}
