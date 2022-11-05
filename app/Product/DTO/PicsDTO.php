<?php

namespace App\Product\DTO;



use App\Product\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Data;

class PicsDTO extends Data
{

    public function __construct (

        #[Image]
        public UploadedFile $a_side,

        #[Image]
        public UploadedFile $b_side,

        #[Exists(Product::class, 'id')]
        public string $id,

        public ?string $path_to_a_side,

        public ?string $path_to_b_side,
    )
    {}
}