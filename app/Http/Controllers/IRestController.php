<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** @template T */
interface IRestController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse;

    /**
     * @param Request $request
     * @param T $obj
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse;

    public function show($id): JsonResponse;

    public function update(Request $request, $id): JsonResponse;

    public function destroy($id): JsonResponse;
}
