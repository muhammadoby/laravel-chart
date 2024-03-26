<?php

namespace App\Http\Controllers;

use App\Models\DailyDataset;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $dataset = DailyDataset::all();
        $data_daily = DailyDataset::paginate(15);
        $profit = DailyDataset::where('is_profit', true);
        $loss = DailyDataset::where('is_profit', false);
        return view('chart', compact('dataset', 'profit', 'loss', 'data_daily'));
    }
}
