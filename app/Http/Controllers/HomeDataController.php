<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\quizTest;
use App\quiz;
use App\Prize;
use App\Question;

class HomeDataController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect('/user-home');
        }
        if (request()->input('ref')) {
            Session::put('ref', request()->input('ref'));
        }
        $auctionList = Auction::with('product.category', 'medias', 'slots', 'bids.user')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();

        $productList = Product::with('category', 'medias')
            ->whereStatus(1)->where('quantity', '>', 0)->latest()->take(15)->get();
        $closedAuctions = Auction::with('product.category', 'medias', 'bids.user')
            ->whereIsClosed(1)->latest()->take(10)->get();

        $upCommingAuction = Auction::with('product.category', 'medias')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();

//        $quiz=DB::table('quizzes')
//            ->select('*')
//            ->where('status',1)
//            ->get();
//
//
//        if(sizeof($quiz)>0)
//        {
//
//            $question = DB::table('questions')
//                ->select('*')
//                ->where('quiz_id', $quiz[0]->id)
//                ->get();
//
//
////            return view('site.pages.quizTest', ['quiz' => $quiz, 'question' => $question]);
//
//        }
//        else {
//
//            $message="No quiz available";
//            return view('site.home-partials.quizTest', ['msg' => $message]);
//
//        }

        return view('site.pages.home', [
            'auctionList' => $auctionList,
            'productList' => $productList,
            'closedAuctions' => $closedAuctions,
            'upCommingAuction' => $upCommingAuction,
//            'quiz'=>$quiz,
//            'question'=>$question,

        ]);
    }

    public function land()
    {

        return view('site.pages.landing');
    }

    public function quizland()
    {
        if(auth()->user())
        {
            return redirect('/quiz-home');
        }

        $quiz = DB::table('quizzes')
            ->select('*')
            ->where('quiz_type', '=', 'First')
            ->where('status', 1)
            ->get();

        $quizheads = DB::table('quizheads')
            ->select('*')
            ->get();

        $prize = Prize::all();

        if (sizeof($quiz) > 0) {

            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $quiz[0]->id)
                ->get();


//            return view('site.pages.quizTest', ['quiz' => $quiz, 'question' => $question]);

        } else {

            $message = "No quiz available";
            return view('galaxy.quizInd', ['msg' => $message]);

        }
        return view('galaxy.quizInd', [

            'quiz' => $quiz,
            'question' => $question,
            'quizhead' => $quizheads,
            'prize' => $prize,
        ]);


    }



    public function next()
    {
        $next=DB::table('quizzes')
        ->select('*')
        ->where('quiz_type','=','Next')
        ->where('status',1)
        ->get();

        $quizheads=DB::table('quizheads')
        ->select('*')
        ->get();

        $prize=Prize::all();

        if(sizeof($next)>0)
        {

        $question = DB::table('questions')
        ->select('*')
        ->where('quiz_id', $next[0]->id)
        ->get();


        //            return view('site.pages.quizTest', ['quiz' => $quiz, 'question' => $question]);

        }
        else {

            $message="No quiz available";
            return view('galaxy.next', ['msg' => $message]);

        }
        return view('galaxy.next',[

            'quiz'=>$next,
            'question'=>$question,
            'quizhead'=>$quizheads,
            'prize'=>$prize,
        ]);

    }

}
