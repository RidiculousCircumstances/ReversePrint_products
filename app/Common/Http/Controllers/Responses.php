<?php

namespace App\Common\Http\Controllers;

trait Responses
{
    public function is404 (bool $result) {
        if ($result) {
             return response('Success', 200);
        }
         return response('Not found', 404);
    }
}