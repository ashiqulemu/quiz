<?php

namespace App\Http\Controllers;

use App\quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Question;
use App\Score;
use function bar\baz\foo;

class QuizController extends Controller
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
    public function create(Request $request)
    {
        $user = auth()->user()->id;
        $type=$request->quiz_type;
        $quiz = $request->input('quiz');
        $status = 1;
        $expiry_date = $request->input('expiry_date');
        $admin_id = $user;

        $table = DB::table('quizzes')
            ->select('id')
            ->where('quiz_type', $type )
            ->where('status', 1)
            ->get();

        if (sizeof($table)>0)  {

            quiz::where('id', $table[0]->id)->update([
                'status' => 0
            ]);

            $validatedData = $request->validate([
                'quiz' => 'required|string',
                'quiz_type' => 'required|string',
                'expiry_date' => 'required|date'
            ]);

//            $data = array(['quiz' => $quiz,'quiz_type'=> $type, 'status' => $status, 'expiry_date' => $expiry_date, 'admin_id' => $admin_id]);
//            DB::table('quizzes')->insert($data);
            $quiz = quiz::create([

                'quiz' => $quiz,
                'quiz_type'=> $type,
                'status' => $status,

                'expiry_date' => $expiry_date,
                'admin_id' => $admin_id,

            ]);
            $quizid = DB::table('quizzes')
                ->select('id')
//                ->where('quiz_type','=',$type && 'status', 1)
                ->where('quiz_type', $type )
                ->where('status', 1)
                ->get();


            return redirect()->route('question.create', ['quiz' => $quizid[0]->id]);

        } else {
            $validatedData = $request->validate([
                'quiz' => 'required|string',
                'expiry_date' => 'required|date'
            ]);
//            $quiz = $request->input('quiz');
//            $status = 1;
//
//            $expiry_date = $request->input('expiry_date');
//
//            $admin_id = $user;
//            $quiz_type=$type;
//            $data = array('quiz' => $quiz, 'quiz_type'=> $quiz_type, 'status' => $status, 'expiry_date' => $expiry_date, 'admin_id' => $admin_id);
//            DB::table('quizzes')->insert($data);

            $quiz = quiz::create([

                'quiz' => $quiz,
                'quiz_type'=> $type,
                'status' => $status,

                'expiry_date' => $expiry_date,
                'admin_id' => $admin_id,

            ]);


            $quizid = DB::table('quizzes')
                ->select('id')
                ->where('quiz_type', $type )
                ->where('status', 1)
                ->first();


            return redirect()->route('question.create', ['quiz' => $quizid[0]->id]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(quiz $quiz,Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required',

        ]);
        $quiz->quiz = request('name');
        $quiz->expiry_date=request('expiry_date');
        $quiz->save();

        return redirect()->route('quiz.edit', ['quiz' => $quiz->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(quiz $quiz,Request $request)
    {

        $validatedData = $request->validate([
            'time' => 'required|numeric'
        ]);
        // Get quiz scores within selceted time frame
        $date = Carbon::now()->subMinutes(request('time'));
        $scores = $quiz->scores()->where('created_at', '>', $date)->get();

        $users = [];
        // Get username of each score
        foreach ($scores as $score) {
            $score->name = $score->user()->get()[0]->name;
        }
        $scores = $scores->sortByDesc('score');
        return view('teacher.quiz.scores', compact('scores', 'quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz $quiz)
    {
        return view('admin.pages.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz $quiz)
    {
        $questions = $quiz->questions()->get();
        // Delete associated answers with question
        foreach ($questions as $question) {

            $question->delete();
        }

        $quiz->delete();

        return redirect()->route('admin.pages.quiz.dasboard');
    }

}
