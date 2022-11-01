<?php

namespace App\Product\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ColorDTO extends DataTransferObject
{
    public ?int $id;

    public string $name;

    public string $value;
}
