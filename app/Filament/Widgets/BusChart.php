<?php

namespace App\Filament\Widgets;

use App\Models\Route;
use Filament\Widgets\ChartWidget;

class BusChart extends ChartWidget
{
    protected static ?int $sort = 2; // Menentukan urutan widget di dashboard

    protected static ?string $heading = "Jumlah Bus per Rute";

    protected static string $chart = "bar"; // Kita akan membuat grafik batang (bar chart)

    protected function getData(): array
    {
        // Ambil semua rute dan hitung jumlah bus di setiap rute
        $routes = Route::withCount("buses")->get();

        // Siapkan data untuk grafik
        return [
            "datasets" => [
                [
                    "label" => "Jumlah Bus",
                    "data" => $routes->pluck("buses_count"), // Ambil jumlah bus dari setiap rute
                    "backgroundColor" => [
                        "#ff6384", // Warna untuk grafik
                        "#36a2eb",
                        "#cc65fe",
                        "#ffce56",
                        "#4bc0c0",
                    ],
                    "borderColor" => [
                        "#ff6384", // Warna untuk grafik
                        "#36a2eb",
                        "#cc65fe",
                        "#ffce56",
                        "#4bc0c0",
                    ],
                ],
            ],
            "labels" => $routes->pluck("name"), // Label di sumbu X (nama rute)
        ];
    }

    protected function getType(): string
    {
        return "bar";
    }
}
