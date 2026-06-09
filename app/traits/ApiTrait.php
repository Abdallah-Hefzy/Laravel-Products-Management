<?php

namespace App\traits;

use Ramsey\Uuid\Type\Integer;

trait ApiTrait
{

    public function successMessage(string $message = "", int $code = 200)
    {

        return response()->json([
            'message' => $message,
            'errors' => (object)[],
            'data' => (object)[],

        ], $code);
    }

    public function errorMessage(array $errors = [] ,string $message = "" , int $code = 404)
    {

        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'data' => (object)[],

        ], $code);
    }

    public function data(array $data = [] ,string $message = "" , int $code = 200)
    {

        return response()->json([
            'message' => $message,
            'errors' => (object)[],
            'data' => $data,

        ], $code);
    }
}
