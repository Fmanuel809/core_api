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
       return var_dump(Storage::exists('img/products/i7.jpg');
    }
}
