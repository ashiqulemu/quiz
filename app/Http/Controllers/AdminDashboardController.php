<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\quiz;
use App\User;

class AdminDashboardController extends Controller
{
   public function dashboard() {
      
       return view('admin.pages.dashboard', [
           'totalOrders'            => 0,
           'totalTodayOrders'       =>0,
           'totalAuctions'          => 0,
           'totalUpComingAuctions'  => 0,
       ]);



   }

    public function quizindex()
    {


        $first=DB::table('quizzes')
            ->select('id','quiz')
            ->where('quiz_type','=','First')
            ->where('status','=',1)
            ->first();

        $next=DB::table('quizzes')
            ->select('id','quiz')
            ->where('quiz_type','=','Next')
            ->where('status','=',1)
            ->first();

        $record=DB::table('prizes')
            ->select('*')
            ->get();


        return view('admin.pages.quiz.dasboard', ['first' => $first, 'next' => $next,'record' => $record]);

    }


}
