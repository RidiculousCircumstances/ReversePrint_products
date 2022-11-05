<?php

namespace App\Common\Http\Controllers;

trait Responses
{
    public function is404 (mixed $result) {
        if ($result) {
             return response($result, 200);
        }
         return response('Not found', 404);
    }
}