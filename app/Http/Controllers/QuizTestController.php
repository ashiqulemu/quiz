<?php

namespace App\Http\Controllers;

use App\quizTest;
use Illuminate\Http\Request;
use App\quizAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\quiz;
use App\Question;
use App\Score;
use Illuminate\Session;
use App\Answer;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\quizhead;

class QuizTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\quizTest $quizTest
     * @return \Illuminate\Http\Response
     */
    public function show(quizTest $quizTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\quizTest $quizTest
     * @return \Illuminate\Http\Response
     */
    public function edit(quizTest $quizTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\quizTest $quizTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quizTest $quizTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quizTest $quizTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(quizTest $quizTest)
    {
        //
    }

    public function test()
    {

        $quiz = DB::table('quizzes')
            ->select('*')
            ->where('status', 1)
            ->get();


        if (sizeof($quiz) > 0) {

            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $quiz[0]->id)
                ->get();


            return view('quiz.quizTest', ['quiz' => $quiz, 'question' => $question]);

        } else {

            $message = "No quiz available";
            return view('quiz.quizTest', ['msg' => $message]);

        }
    }

    public function save(Request $request)
    {


        $quizid = $request->quiz;
        $id = $request->questions;
//        $radio=$request->option;
        $radio = [];
        for ($i = 1; $i <= sizeof($id); $i++) {
            $options = "option" . $request->questions[$i];
            $abs = $request->$options;

            array_push($radio, $abs);
        }


        $answer = new quizAnswer($radio, $id, $quizid);
        $request->session()->put('answer', $answer);

        return redirect('/quiz-login');


    }

    public function log()
    {


        return view('quiz.login.login');
    }

    public function nextlog()
    {


        return view('quiz.login.next-login');
    }

    public function quizlog(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user()->id;

            $abc = $request->session()->get('answer');

            $radio = $abc[0]->radio;
            $abcd = $abc->id;


            $check = DB::table('answers')
                ->join('questions', 'answers.question_id', '=', 'questions.id')
                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                ->where('answers.user_id', '=', $user)
                ->where('quizzes.quiz_type', '=', 'First')
                ->where('quizzes.status', '=', 1)
                ->select('answer.id')
                ->count();

            if ($check < 1) {
                for ($i = 0; $i < count($radio); $i++) {
                    $answer = new Answer();
                    $answer->answer = $radio[$i];
                    $answer->user_id = $user;
                    $answer->question_id = $abcd[$i];
                    $answer->save();


                }
                $request->session()->flash('answer');

                return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
            } else {
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
            }
        } else {
            return redirect('/quiz-login')->withErrors(['please check username and password']);
        }
    }

    public function nextquizlog(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user()->id;

            $abc = $request->session()->get('answer');
            $radio = $abc->radio;
            $abcd = $abc->id;

            $check = DB::table('answers')
                ->join('questions', 'answers.question_id', '=', 'questions.id')
                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                ->where('answers.user_id', '=', $user)
                ->where('quizzes.quiz_type', '=', 'Next')
                ->where('quizzes.status', '=', 1)
                ->select('answer.id')
                ->count();

            if ($check < 1) {
                for ($i = 0; $i < count($radio); $i++) {
                    $answer = new Answer();
                    $answer->answer = $radio[$i];
                    $answer->user_id = $user;
                    $answer->question_id = $abcd[$i];
                    $answer->save();


                }
                $request->session()->flash('answer');

                return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
            } else {
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
            }
        } else {
            return redirect('/quiz-login')->withErrors(['please check username and password']);
        }
    }

    public function quizregister(Request $request)
    {
        $user = DB::table('users')
            ->select('id')
            ->where('email', $request->email)
            ->get();


        if (sizeof($user) <= 0) {

            $ruser = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'credit_balance' => 10,
                'singUp_credit' => 10,

            ]);


            $abc = $request->session()->get('answer');
            $quizid = $abc->quizid;
            dd($quizid);
            $radio = $abc->radio;
            $abcd = $abc->id;
            Auth::loginUsingId($ruser->id);
            $ruser = auth()->user()->id;

            $check = DB::table('answers')
                ->join('questions', 'answers.question_id', '=', 'questions.id')
                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                ->where('answers.user_id', '=', $ruser)
                ->where('quizzes.quiz_type', '=', 'First')
                ->where('quizzes.status', '=', 1)
                ->select('answer.id')
                ->count();

            if ($check < 1) {
                for ($i = 0; $i < count($radio); $i++) {
                    $answer = new Answer();
                    $answer->answer = $radio[$i];
                    $answer->user_id = $ruser;
                    $answer->question_id = $abcd[$i];
                    $answer->save();


                }
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
            } else {
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
            }


        }


//           $authUser = $this->findOrCreate($input);
//            Auth::loginUsingId($authUser->id);

        else {
            return redirect('/quiz-login')->withErrors(['You are already registered. Please login']);
        }


    }

    public function nextquizregister(Request $request)
    {
        $user = DB::table('users')
            ->select('id')
            ->where('email', $request->email)
            ->get();


        if (sizeof($user) <= 0) {

            $ruser = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'credit_balance' => 10,
                'singUp_credit' => 10,

            ]);

            Auth::loginUsingId($ruser->id);
            $ruser = auth()->user()->id;
            $abc = $request->session()->get('answer');
            $radio = $abc->radio;
            $abcd = $abc->id;
            $check = DB::table('answers')
                ->join('questions', 'answers.question_id', '=', 'questions.id')
                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                ->where('answers.user_id', '=', $ruser)
                ->where('quizzes.quiz_type', '=', 'Next')
                ->where('quizzes.status', '=', 1)
                ->select('answer.id')
                ->count();

            if ($check < 1) {
                for ($i = 0; $i < count($radio); $i++) {
                    $answer = new Answer();
                    $answer->answer = $radio[$i];
                    $answer->user_id = $ruser;
                    $answer->question_id = $abcd[$i];
                    $answer->save();


                }
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
            } else {
                $request->session()->flash('answer');
                return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
            }


        }


//           $authUser = $this->findOrCreate($input);
//            Auth::loginUsingId($authUser->id);

        else {
            return redirect()->back()->withErrors(['You are already registered. Please login']);
        }


    }

    public function registeredQuiz(Request $request)
    {
        if(auth()->user())
        {   
       
        $userid=3;
       
        $quizid = $request->quiz;
        $questionid = $request->questions;
        
        $check = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
            ->where('answers.user_id', '=', $userid)
            ->where('quizzes.id', '=', $quizid)
            ->select('answer.id')
            ->count();


        if ($check < 1) {
            for ($i = 1; $i <= sizeof($questionid); $i++) {
                $answer = new Answer();
                $options = "option" . $request->questions[$i];
                $a = $request->$options;
                $answer->answer = $a;
                $answer->user_id = $userid;
                $answer->question_id = $request->questions[$i];
                $answer->save();
            }
            return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
        } else {

            return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
        }
    }else{
        return redirect()->back()->withErrors(['You are not logged in. Please login or register']);
    }


    }

    public function nextregisteredQuiz(Request $request)
    {

        $userid = auth()->user()->id;
        $quizid = $request->quiz_id;
        $questionid = $request->questions;
        $check = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
            ->where('answers.user_id', '=', $userid)
            ->where('quizzes.quiz_type', '=', 'Next')
            ->where('quizzes.status', '=', 1)
            ->select('answer.id')
            ->count();
        if ($check < 1) {
            for ($i = 1; $i <= sizeof($questionid); $i++) {
                $answer = new Answer();
                $options = "option" . $request->questions[$i];
                $a = $request->$options;
                $answer->answer = $a;
                $answer->user_id = $userid;
                $answer->question_id = $request->questions[$i];
                $answer->save();
            }
            return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
        } else {

            return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
        }


    }

    public function quizedit()
    {

        $quiz = DB::table('quizzes')
            ->select('*')
            ->where('status', 1)
            ->get();


        if (sizeof($quiz) > 0) {

            return view('site.login.user.quiz.edit.firstquiz', ['quiz' => $quiz]);

        } else {

            $message = "No quiz available";
            return view('site.login.user.quiz.edit.firstquiz', ['msg' => $message]);

        }


    }

    public function editquiz($id)
    {

        $qid = (int)$id;


        $uid = auth()->user()->id;
        $fcheck = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
            ->where('answers.user_id', '=', $uid)
            ->where('quizzes.id', '=', $qid)
            ->select('answers.answer','answers.id')
            ->get();

        if (sizeof($fcheck)== 0) {
            $msg = "Nothing to Edit";
            return view('site.login.user.quiz.edit.firstquiz', ['msg' => $msg]);
        } else {
            $quiz = DB::table('quizzes')
                ->select('*')
                ->where('id', '=', $qid)
                ->get();


            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $quiz[0]->id)
                ->get();

            return view('site.login.user.quiz.edit.edit', ['quiz' => $quiz, 'question' => $question, 'fcheck' => $fcheck]);

        }

    }

        public function quizupdate(Request $request,$id)
        {
            $qid=(int)$id;
            $userid = auth()->user()->id;
            $questionid = $request->questions;
            $answers=$request->aid;
            for ($i = 1; $i <= sizeof($questionid); $i++) {
                $answer = Answer::findOrFail($answers[$i]);
                $answer ->update([
                $options = "option" . $request->questions[$i],
                $a = $request->$options,
                'answer'=> $a,
                    'user_id'=> $userid,
                    'question_id'=>$questionid[$i],

            ]);
            }
            $msg="Answer updated successfully";
            return view("site.login.user.quiz.edit.firstquiz",['msg'=>$msg]);

                }

                }
