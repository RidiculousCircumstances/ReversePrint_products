<?php

namespace App\Product;

use App\Http\Controllers\Controller;
use App\Product\DTO\ProductInstanceDTO;
use App\Product\Requests\ProductCreateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    public function create(ProductCreateRequest $req): array
    {
        $req['productPathASide'] = $req->file('sideA')->store('images');
        $req['productPathBSide'] = $req->file('sideB')->store('images');

        return $this->productService->createProduct(ProductInstanceDTO::fromRequest($req));
    }

    public function get(): array
    {
        return $this->productService->getAll();
    }

    public function getById(Request $req)
    {
        return $this->productService->getById($req->route('id'));
    }

    public function delete(Request $req)
    {
        return $this->productService->delete($req->route('id'));
    }
}
