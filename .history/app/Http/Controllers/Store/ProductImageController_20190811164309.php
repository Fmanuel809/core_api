<?php

namespace App\Http\Controllers\Store;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException as NotFoundError;

class ProductImageController extends Controller
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

    public function getImage($idProduct)
    {
       $path = ('/img/products/'.$idProduct.'.jpg');
       $file = Storage::get($path);
       $type = Storage::mimeType($path);

       return response($file, 200, ['Content-Type' => $type]);
    }
}
