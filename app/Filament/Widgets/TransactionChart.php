<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions (30 Days)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Ambil data transaksi per bulan untuk tahun ini
        $data = Trend::query(Transaction::where('status', 'success'))
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth()
            )
            ->perDay() // Hitung data per bulan
            ->sum('total'); // Hitung total transaksi per bulan berdasarkan 'total'

        return [
            'datasets' => [
                [
                    'label' => 'Total Transactions',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => true,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date), // Format tanggal untuk label bulan
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
