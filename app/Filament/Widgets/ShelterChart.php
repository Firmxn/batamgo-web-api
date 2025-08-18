<?php

namespace App\Filament\Widgets;

use App\Models\Shelter;
use Filament\Widgets\ChartWidget;

class ShelterChart extends ChartWidget
{
    protected static ?int $sort = 4; // Menentukan urutan widget di dashboard

    protected static ?string $heading = "Jumlah Halte per Rute";

    protected static string $chart = "bar"; // Kita akan membuat grafik batang (bar chart)

    protected function getData(): array
    {
        return [
            ($shelters = Shelter::withCount("routes")->get()),
            "datasets" => [
                [
                    "label" => "Jumlah Halte",
                    "data" => $shelters->pluck("routes_count"), // Ambil jumlah rute dari setiap halte
                    "backgroundColor" => [
                        "#ff6384", // Warna untuk grafik
                        "#36a2eb",
                        "#cc65fe",
                        "#ffce56",
                        "#4bc0c0",
                    ],
                ],
            ],
            "labels" => $shelters->pluck("name"), // Label di sumbu X (nama halte)
        ];
    }

    protected function getType(): string
    {
        return "bar";
    }
}
