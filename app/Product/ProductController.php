<?php

namespace App\Product;

use App\Http\Controllers\Controller;
use App\Product\DTO\PicsDTO;
use App\Product\DTO\ProductDTO;
use Illuminate\Http\Request;
use App\Product\DTO\ProductInstanceDTO;
use Spatie\LaravelData\Data;





class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService){}

    /**
     * @param Request $req
     * @param Data $DTO
     * @return Data
     */
    private function fromFormData(Request $req, string $DTO): Data {
        $plain = $req->data;
        $json = json_decode($plain);
        foreach ($json as $key => $value) {
            if(gettype($value) === "object") {
                foreach ($value as $nestedkey => $nestedvalue) {
                    $req[$key] = $req[$key] ? $req[$key] + [$nestedkey => $nestedvalue] : [$nestedkey => $nestedvalue];
                }
            } else {
                $req[$key] = $value;
            }
        }
        return $DTO::from($req);
    }


    public function createInstanceWhole(Request $req): array
    {
        if (!$req->file('sideA') || !$req->file('sideB')) {
            return abort(422, 'Image must be specified');
        }

        /**
         * @var ProductInstanceDTO $dto
         */
        $dto = $this->fromFormData($req, ProductInstanceDTO::class);
        $dto->product->path_to_a_side = $req->file('sideA')->store('images');
        $dto->product->path_to_b_side = $req->file('sideB')->store('images');
        return $this->productService->createInstanceWhole($dto);
    }


    public function createInstancePartial (Request $req) {

    }

    public function createProduct (Request $req): ProductDTO
    {
        return $this->productService->createProduct(ProductDTO::from($req));
    }

    public function loadProductPics (Request $req) {

        if (!$req->file('a_side') || !$req->file('b_side')) {
            return abort(422, 'Image must be specified');
        }

       return $this->productService->loadPics(PicsDTO::from($req));
    }



    public function createColor (Request $req) {

    }

    public function createSize (Request $req) {

    }

    public function getProducts (Request $req) {

    }

    public function getColors (Request $req) {

    }

    public function getSizes (Request $req) {

    }




//    public function update(Request $req) {
//
//        /**
//         * @var ProductInstanceDTO $dto
//         */
//        $dto = $this->fromFormData($req, ProductInstanceDTO::class);
//        $dto->product->path_to_a_side = $req->file('sideA')?->store('images');
//        $dto->product->path_to_b_side = $req->file('sideB')?->store('images');
//
//        return $this->productService->update($dto, $req->route('id'));
//    }

    public function getInstances(): array
    {
        return $this->productService->getInstances();
    }

    public function getInstance(Request $req): array
    {
        return $this->productService->getInstance($req->route('id'));
    }

    public function deleteInstance(Request $req)
    {
        $result = $this->productService->deleteInstance($req->route('id'));
        $result ? response(200) : abort(404);
    }


}
