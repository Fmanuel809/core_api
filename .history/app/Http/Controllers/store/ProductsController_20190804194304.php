<?php
namespace App\Http\Controllers\Store;

use Validator;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(Request $request) {

    }

    public function index()
    {

    }

    public function get($id)
    {

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string',
            'username' => 'required|unique:users',
            'email'    => 'required|unique:users|email',
            // Regex: Uppercase, Lowercase, Numbers
            'password' => 'required|regex:"^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$"',
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

    public function update ($id)
    {

    }

    public function delete($id)
    {

    }
}
