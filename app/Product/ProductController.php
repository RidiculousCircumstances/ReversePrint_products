<?php

namespace App\Product;

use App\Http\Controllers\Controller;
use App\Product\Requests\ProductCreateRequest;
use App\Product\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Product\DTO\ProductInstanceDTO;
use PhpParser\Node\Expr\Cast\Object_;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Size;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use stdClass;


class Dto extends Data {
    #[Size(9)]
    public int $test;
}

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService){}

    public function create(Request $req): array
    {


        if (!$req->file('sideA') || !$req->file('sideB')) {
            return abort(422, 'Image must be specified');
        }

        $plain = $req->data;
        $json = json_decode($plain);
        foreach ($json as $key => $value) {
            if(gettype($value) === "object") {
                foreach ($value as $nestedkey => $nestedvalue) {
                    $req[$key] = $req[$key] ? $req[$key] + [$nk => $nv] : [$nk => $nv];
                }
            } else {
                $req[$key] = $value;
            }
        }
        $dto = ProductInstanceDTO::from($req);
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

    public function test(Request $req) {
        $req['s1'] = ['s2' => 'sssd'];

        $plain = $req->data;
        $json = json_decode($plain);
        foreach ($json as $key => $value) {
            $req[$key] = $value;
        }
        $result = Dto::from($req);
    }
}
