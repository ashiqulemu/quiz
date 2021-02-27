<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Auth;

use App\Prize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\quiz;
use App\Question;
use App\Score;
use Illuminate\Session;
use App\Answer;
use App\Winner;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $score=(int)$request->score;
        $prizes=(int)$request->prize;


        $prize=new Prize();
        $prize->score=$score;
        $prize->gift=$prizes;
        $prize->save();

        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize)
    {
        dd('ewhrjew rjew ruew ruew');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prize = Prize::findOrFail($id);
        $prize->delete();
        return redirect()->back();
    }
    public function prizeupdates(Request $request,$id)
    {

        $prize = Prize::findOrFail($id);
        $prize->update([
            'score'=>(int)$request->score,
            'gift'=>(int)$request->prize,

        ]);
        return redirect()->back();

    }
    public function publishresult($id)
    {
        $quizid=$id;
        $questionAnswer= DB::table('questions')
            ->select('id','answer')
            ->where('quiz_id',$quizid)
            ->get();

        $userAnswer = DB::table('answers')
            ->leftJoin('questions','questions.id','=','answers.question_id')
            ->where('questions.quiz_id',$quizid )
            ->select ('answers.user_id','answers.answer')
            ->orderBy('answers.id')
            ->get();

        $publishCheck=DB::table('winners')
            -> select('id')
            ->where('quiz_id',$quizid)
            ->count();

        if($publishCheck>0 )
        {
//            Session::flash('message', "You have already published for this quiz");

            return redirect()->back()->withErrors(['You have already published for this quiz']);
        }
    else {
        $j = 0;
        $cnt = 0;
        for ($i = 0; $i <= sizeof($userAnswer); $i++) {
            if ($j < sizeof($questionAnswer)) {

                if ($userAnswer[$i]->answer == $questionAnswer[$j]->answer) {
                    $cnt++;
                }

                $j++;
            } else {
                $userid = $userAnswer[$i - 1]->user_id;


                $lowest = DB::table('prizes')
                    ->select('score', 'prize')
                    ->MIN('score');
//                        $highest=DB::table('prizes')
//                            ->select('score','prize')
//                            ->MAX('score');
////                                ->get();


                if ($cnt >= $lowest) {

                    $gift = DB::table('prizes')
                        ->select('gift')
                        ->where('score', $cnt)
                        ->get();


                    $win = $gift[0]->gift;

                    $winner = new Winner();
                    $winner->point = $cnt;
                    $winner->gift = $win;
                    $winner->quiz_id = $quizid;
                    $winner->user_id = $userid;
                    $winner->save();

                    $totalCredit = DB::table('users')
                        ->select('credit_balance')
                        ->where('id', $userid)
                        ->first();

                    User::where('id', $userid)->update([
                        'credit_balance' => $totalCredit->credit_balance + $win
                    ]);

                }

                $cnt = 0;
                $j = 0;
                if ($i == sizeof($userAnswer)) {
                    return redirect()->back()->withErrors(['The result has successfully published.']);
                } else {
                    if ($userAnswer[$i]->answer == $questionAnswer[$j]->answer) {
                        $cnt++;
                    }
                    $j++;
                }


            }

        }

    }

    }
    public function userResult()
    {
        $id=auth()->user()->id;
        $first=DB::table('winners')
            ->join('quizzes','quizzes.id','=','winners.quiz_id')
            ->select ('quizzes.quiz','quizzes.quiz_type','winners.point','winners.gift' ,'winners.created_at')
            ->where('winners.user_id',$id)
            ->where('quizzes.quiz_type','=','First')
            ->orderBy('winners.quiz_id','desc')
            ->get();

        $next=DB::table('winners')
            ->join('quizzes','quizzes.id','=','winners.quiz_id')
            ->select ('quizzes.quiz','quizzes.quiz_type','winners.point','winners.gift' ,'winners.created_at')
            ->where('winners.user_id',$id)
            ->where('quizzes.quiz_type','=','Next')
            ->orderBy('winners.quiz_id','desc')
            ->get();

        $fexp=DB::table('quizzes')
                ->select('expiry_date')
                ->where('quiz_type','=','First')
                ->where('status','=',1)
                ->get();
        $nexp=DB::table('quizzes')
            ->select('expiry_date')
            ->where('quiz_type','=','Next')
            ->where('status','=',1)
            ->get();


        return view ('site.login.user.quiz.quiz-result',['first' => $first, 'next' => $next,'fexp'=>$fexp,'nexp'=>$nexp]);
    }
}
