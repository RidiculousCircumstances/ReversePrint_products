<?php

namespace App\Product\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SizeDTO extends DataTransferObject
{
    public ?int $id;

    public string $value;
}
