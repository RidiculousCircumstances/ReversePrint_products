<?php

namespace App\Product;

use App\Common\Http\Controllers\Controller;
use App\Product\DTO\ColorDTO;
use App\Product\DTO\PicsDTO;
use App\Product\DTO\ProductDTO;
use App\Product\DTO\ProductInstancePartialDTO;
use App\Product\DTO\SizeDTO;
use Illuminate\Http\Request;
use App\Product\DTO\ProductInstanceWholeDTO;
use Spatie\LaravelData\DataCollection;



class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService){}

    public function createInstanceWhole(Request $req): array
    {
        if (!$req->file('sideA') || !$req->file('sideB')) {
            return abort(422, 'Image must be specified');
        }

        /**
         * @var ProductInstanceWholeDTO $dto
         */
        $dto = ProductInstanceWholeDTO::formData($req);
        $dto->product->path_to_a_side = $req->file('sideA')->store('images');
        $dto->product->path_to_b_side = $req->file('sideB')->store('images');
        return $this->productService->createInstanceWhole($dto);
    }


    public function createInstancePartial (Request $req): ProductInstanceWholeDTO
    {
        return $this->productService->createInstancePartial(ProductInstancePartialDTO::from($req));
    }

    public function createProduct (Request $req): ProductDTO
    {
        return $this->productService->createProduct(ProductDTO::from($req));
    }

    public function loadProductPics (Request $req): ProductDTO
    {
        if (!$req->file('a_side') || !$req->file('b_side')) {
            return abort(422, 'Image must be specified');
        }

        return $this->productService->loadPics(PicsDTO::from($req));
    }

    public function createColor (Request $req): ColorDTO
    {
        return $this->productService->createColor(ColorDTO::from($req));
    }

    public function createSize (Request $req): SizeDTO
    {
        return $this->productService->createSize(SizeDTO::from($req));
    }

    public function getProducts (): DataCollection
    {
        return $this->productService->getProducts();
    }

    public function getColors (): DataCollection
    {
        return $this->productService->getColors();
    }

    public function getSizes (): DataCollection
    {
        return $this->productService->getSizes();
    }

    public function getInstances(): DataCollection
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
        return $this->is404($result);
    }

    public function deleteSize (Request $req) {
        $result = $this->productService->deleteSize($req->route('id'));
        return $this->is404($result);
    }

    public function deleteColor (Request $req) {
        $result = $this->productService->deleteColor($req->route('id'));
        return $this->is404($result);
    }

    public function deleteProduct (Request $req) {
        $result = $this->productService->deleteProduct($req->route('id'));
        return $this->is404($result);
    }


}
