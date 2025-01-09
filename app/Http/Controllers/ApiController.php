<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function index()
    {
        $json = file_get_contents(storage_path('app/data.json'));
        $data = json_decode($json, true);
        return response()->json($data);
    }
}
