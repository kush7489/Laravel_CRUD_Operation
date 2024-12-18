<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Graph_Controller extends Controller
{

    public function show_chart()
    {
        // $branchCounts  = DB::table('user__details', DB::raw('count(*) as total'))->groupBy('branch')->get();
        $branchCounts = DB::table('user__details')
            ->select('branch', DB::raw('count(*) as total'))
            ->groupBy('branch')
            ->get();
        $categoryCounts = DB::table('user__details')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
        $courseCounts = DB::table('user__details')
            ->select('course', DB::raw('count(*) as total'))
            ->groupBy('course')
            ->get();
        $departmentCounts = DB::table('user__details')
            ->select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->get();
        dd($departmentCounts);
        return view('chart', compact('branchCounts', 'categoryCounts', 'courseCounts','departmentCounts'));
    }
}
