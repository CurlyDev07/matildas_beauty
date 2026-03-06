<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\OrderSource;

class OrderSourceController extends Controller
{
    public function index()
    {
        $sources = OrderSource::active()
            ->get(['id', 'name', 'type', 'description', 'color']);

        return response()->json($sources);
    }
}
