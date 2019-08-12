<?php
namespace App\Http\Controllers\Store;

use Validator;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException as NotFoundError;

class ProductsController extends Controller
{
    public function __construct(Request $request) {

    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function get($id)
    {
        $product = Product::find($id);

        if(empty($product)) return response()->json(['error' => 'Product Not Found.'], 400);

        return response()->json($product, 200);
    }

    public function create(Request $request)
    {

        /*$this->validate($request, [
            'description'  => 'required',
            'name'         => 'required',
        ]);*/

        // $data = $request->json()->all();
        $file = $request->file('image');
        return response($file, 200);
        $translations = [
            [
                'locale' => 'en',
                'name'   =>  $data['name'],
                'description' => $data['description']
            ],
            [
                'locale' => 'en',
                'name'   =>  $data['name'],
                'description' => $data['description']
            ]
        ];


        $image = $request->url_image->store('img/products');

        $dataSave     = [
            'url_image' => $image,
        ];

        foreach ($translations as $t) {
            $dataSave[$t['locale']] = [
                'name'        => $t['name'],
                'description' => $t['description']
            ];
        }

        $product = Product::create($dataSave);
        return response()->json($product, 201);

    }

    public function update (Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name'         => 'required',
                'description'  => 'required',
            ]);

            $locale = $request->header('X-Api-Locale');
            if(!$locale) return response()->json(['error' => 'The X-Api-Locale header was not found.'], 400);

            $product = Product::findOrFail($id);

            $data = $request->json()->all();
            $product->url_image = $data['url_image'];
            $product->is_spent  = $data['is_spent'];
            $product->translateOrNew($locale)->name = $data['name'];
            $product->translateOrNew($locale)->description = $data['description'];
            $product->save();

            return response()->json($product, 200);

        } catch (NotFoundError $e) {
            return response()->json(['error' => 'Product Not Found'], 400);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['success' => 'The product has been deleted.'], 200);
        } catch (NotFoundError $e) {
            return response()->json(['error' => 'Product Not Found'], 400);
        }
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
