<?php
namespace App\Http\Controllers\Store;

use Validator;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $this->validate($request, [
            'name'         => 'required',
            'description'  => 'required',
        ]);

        $data = $request->json()->all();

        $translations = $data['translations'];
        $dataSave     = [
            'url_image' => $data['url_image'],
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

            $locale = $request->header('x-api-locale');

            $product = Product::findOrFail($id);
            $product->translate($locale, true);
            return response()->json($product, 201);

            $data = $request->json()->all();
            $product->url_image = $data['url_image'];
            $product->is_spent  = $data['is_spent'];

            $product->translations[$data['locale']] = [
                'name'        => $data['name'],
                'description' => $data['description']
            ];

            $product->save();



        } catch (NotFoundError $e) {
            return response()->json(['error' => 'Product Not Found'], 400);
        }
    }

    public function delete($id)
    {

    }
}
