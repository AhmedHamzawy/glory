<?php

namespace App\Http\Controllers;
use App\User;
use App\Charts\DashBoard;
use App\Charts\DashBoardone;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(){
        $today_users = User::count();
        $yesterday_users = User::whereDate('created_at', today())->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

        $chart = new DashBoard;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('My dataset', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);

        $chartone = new DashBoard;
        $chartone->labels(['2 days ago', 'Yesterday', 'Today']);
        $chartone->dataset('My dataset', 'pie', [$users_2_days_ago, $yesterday_users, $today_users]);

        $charttwo = new DashBoard;
        $charttwo->labels(['2 days ago', 'Yesterday', 'Today']);
        $charttwo->dataset('My dataset', 'area', [$users_2_days_ago, $yesterday_users, $today_users]);

        return view('admin/Dashboard' , compact('chart','chartone','charttwo'));
    }
}
