<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;    // <-- Tambahkan baris ini
use App\Models\Route;  // <-- Tambahkan baris ini
use App\Models\Shelter; // <-- Tambahkan baris ini
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    public function getRoutes()
    {
        $routes = Route::with('shelters')->get();
        return response()->json([
            'status' => 'success',
            'data' => $routes,
        ]);
    }

    /**
     * Get all shelters.
     */
    public function getShelters()
    {
        $shelters = Shelter::all();
        return response()->json([
            'status' => 'success',
            'data' => $shelters,
        ]);
    }

    /**
     * Get all buses.
     */
    public function getBuses()
    {
        $buses = Bus::with('route')->get();
        return response()->json([
            'status' => 'success',
            'data' => $buses,
        ]);
    }
}
