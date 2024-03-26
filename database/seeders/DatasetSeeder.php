<?php

namespace Database\Seeders;

use App\Models\DailyDataset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalExpenses = 650000000; // Total pengeluaran selama rentang waktu
        $startDate = strtotime('2023-03-01');
        $endDate = strtotime('2024-03-30');
        $days = ($endDate - $startDate) / (60 * 60 * 24); // Jumlah hari dalam rentang waktu

        $dailyExpenses = [];
        $remainingAmount = $totalExpenses;

        for ($i = 0; $i < $days; $i++) {
            $is_profit = rand(0,1);
            $dailyExpense = rand(100000, 3000000); // Pengeluaran harian antara 100 ribu hingga 3 juta
            $dailyExpense = min($dailyExpense, $remainingAmount); // Membatasi agar pengeluaran harian tidak melebihi sisa total

            $dailyExpenses[] = [
                'date' => date('Y-m-d', strtotime("+$i days", $startDate)),
                'amount' => $dailyExpense,
                'is_profit' => $is_profit
            ];

            $remainingAmount -= $dailyExpense;
        }

        // Menambahkan sisa total sebagai pengeluaran pada tanggal terakhir
        $dailyExpenses[count($dailyExpenses) - 1]['amount'] += $remainingAmount;

        // Insert data ke database
        foreach ($dailyExpenses as $data) {
            DailyDataset::create($data);
        }
    }
}
