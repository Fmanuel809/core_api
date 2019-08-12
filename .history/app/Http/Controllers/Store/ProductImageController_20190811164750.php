<?php

namespace App\Http\Controllers\Store;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

        $product = Product::find($idProduct);
        if(!$product) exit('Not Found Image');

        $path = ('/img/products/' . $product->url_image);
        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return response($file, 200, ['Content-Type' => $type]);
    }
}
