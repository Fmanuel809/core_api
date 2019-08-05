<?php
namespace App\Http\Controllers\Store;

use Validator;
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

    public function create()
    {
        $data = $this->request->json()->all();

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

        return response()->json($dataSave, 200);
    }

    public function update ($id)
    {

    }

    public function delete($id)
    {

    }
}
