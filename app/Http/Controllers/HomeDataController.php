<?php

namespace App\Http\Controllers;



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
            'auctionList' => 0,
            'productList' => 0,
            'closedAuctions' => 0,
            'upCommingAuction' =>0,
//            'quiz'=>$quiz,
//            'question'=>$question,

        ]);
    }

    public function land()
    {
        $quiz=DB::table('quizzes')
           ->select('*')
           ->where('status',1)
           ->where('expiry_date','>=',date("Y/m/d"))
           ->where('quiz_type','Commercial')
           ->first();

         
       if(sizeof($quiz)>0)
       {

           $question = DB::table('questions')
               ->select('*')
               ->where('quiz_id', $quiz->id)
               ->get();

            $commercialQuiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type', 'Commercial')
            ->where('id','!=',$quiz->id)
            ->get();
            
            $freeQuiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type', 'Free')
            ->get();
            
            $countAttend=DB::table('quiz_takens')
            ->select('id')
            ->where('quiz_id', $quiz->id)
            ->count();

            return view('site.pages.landing', ['quiz' => $quiz, 'question' => $question,'commercialQuiz'=>$commercialQuiz,'freeQuiz'=>$freeQuiz,'countAttend'=>$countAttend]);

       }
       else {

           $message="No quiz available";
           return view('site.pages.landing', ['msg' => $message]);

       }

       
    }

    public function findQuiz($id)
    {

        $quiz=DB::table('quizzes')
        ->select('*')
        ->where('id',$id)
        ->first();

      
    if(sizeof($quiz)>0)
    {

        $question = DB::table('questions')
            ->select('*')
            ->where('quiz_id', $quiz->id)
            ->get();

        if($quiz->quiz_type == 'Commercial')
            {
       
        $commercialQuiz=DB::table('quizzes')
         ->select('*')
         ->where('quiz_type', 'Commercial')
         ->where('expiry_date','>=',date("Y/m/d"))
         ->where('id','!=',$id)
         ->get();
         $freeQuiz=DB::table('quizzes')
         ->select('*')
         ->where('quiz_type', 'Free')
         ->where('expiry_date','>=',date("Y/m/d"))
         ->get();
            }
            else{

                $commercialQuiz=DB::table('quizzes')
                ->select('*')
                ->where('quiz_type', 'Commercial')
                ->where('expiry_date','>=',date("Y/m/d"))
                ->get(); 

                $freeQuiz=DB::table('quizzes')
                ->select('*')
                ->where('quiz_type', 'Free')
                ->where('expiry_date','>=',date("Y/m/d"))
                ->where('id','!=',$id)
                ->get();
                    
            }
         
         
         
        $countAttend=DB::table('quiz_takens')
         ->select('id')
         ->where('quiz_id', $quiz->id)
         ->count();

         return view('site.pages.landing', ['quiz' => $quiz, 'question' => $question,'commercialQuiz'=>$commercialQuiz,'freeQuiz'=>$freeQuiz,'countAttend'=>$countAttend]);

    }
    else {

        $message="No quiz available";
        return view('site.pages.landing', ['msg' => $message]);

    }
    }

}
