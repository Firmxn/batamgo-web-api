<?php

namespace App\Filament\Widgets;

use App\Models\Route;
use Filament\Widgets\ChartWidget;

class RouteChart extends ChartWidget
{
    protected static ?int $sort = 5; // Menentukan urutan widget di dashboard

    protected static ?string $heading = "Jumlah Rute per Bus";

    protected static string $chart = "bar"; // Kita akan membuat grafik batang

    protected function getData(): array
    {
        return [
            "datasets" => [
                [
                    "label" => "Jumlah Rute",
                    "data" => Route::withCount("buses")
                        ->get()
                        ->pluck("buses_count"), // Ambil jumlah bus dari setiap rute
                    "backgroundColor" => [
                        "#ff6384", // Warna untuk grafik
                        "#36a2eb",
                        "#cc65fe",
                        "#ffce56",
                        "#4bc0c0",
                    ],
                ],
            ],
            "labels" => Route::pluck("name"), // Label di sumbu X (nama rute)
            // 'options' => [
            //     'responsive' => true,
            //     'maintainAspectRatio' => false,
            //     'plugins' => [
            //         'legend' => [
            //             'position' => 'top',
            //         ],
            //         'title' => [
            //             'display' => true,
            //             'text' => 'Jumlah Rute per Bus',
            //         ],
            //     ],
            // ],
        ];
    }

    protected function getType(): string
    {
        return "bar"; // Menggunakan grafik donat
    }
}
