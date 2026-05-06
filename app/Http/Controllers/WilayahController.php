<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class WilayahController extends Controller
{
    private string $base = 'https://ibnux.github.io/data-indonesia';

    public function getProvinces(): JsonResponse
    {
        $data = file_get_contents("{$this->base}/provinsi.json");
        return response()->json(json_decode($data));
    }

    public function getCities($id): JsonResponse
    {
        $data = file_get_contents("{$this->base}/kabupaten/{$id}.json");
        return response()->json(json_decode($data));
    }

    public function getDistricts($id): JsonResponse
    {
        $data = file_get_contents("{$this->base}/kecamatan/{$id}.json");
        return response()->json(json_decode($data));
    }

    public function getVillages($id): JsonResponse
    {
        $data = file_get_contents("{$this->base}/kelurahan/{$id}.json");
        return response()->json(json_decode($data));
    }
}
