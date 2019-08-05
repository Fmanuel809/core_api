<?php
namespace App\Http\Controllers\Store;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $request;

    public function __construct(Request $request) {
        $this->$request = $request;
    }

    public function index()
    {

    }

    public function get($id)
    {

    }

    public function create()
    {

    }

    public function update ($id)
    {

    }

    public function delete($id)
    {

    }
}
