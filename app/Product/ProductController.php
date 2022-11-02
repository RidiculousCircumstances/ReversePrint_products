<?php

namespace App\Product;

use App\Http\Controllers\Controller;
use App\Product\Requests\ProductCreateRequest;
use App\Product\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Product\DTO\ProductInstanceDTO;


class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService){}

    public function create(Request $req): array
    {
        if (!$req->file('sideA') || !$req->file('sideB')) {
            return abort(422, 'Image must be specified');
        }
        $dto = ProductInstanceDTO::from($req->data);
        $dto->product->path_to_a_side = $req->file('sideA')->store('images');
        $dto->product->path_to_b_side = $req->file('sideB')->store('images');

        return $this->productService->createProduct($dto);
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
        $result = $this->productService->delete($req->route('id'));
        $result ? response(200) : abort(404);
    }

    public function update(ProductUpdateRequest $req) {

        $req['productPathASide'] = $req->file('sideA')?->store('images');
        $req['productPathBSide'] = $req->file('sideB')?->store('images');

        $m = $req->toArray();
        $a = ProductInstanceDTO::from($m);

        $this->productService->update(ProductInstanceDTO::from($req), $req->route('id'));

    }
}
