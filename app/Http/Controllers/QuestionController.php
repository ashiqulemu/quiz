<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\quiz;
use App\Question;
use App\Score;




class QuestionController extends Controller
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
    public function create(quiz $quiz)
    {
//        return view('teacher.questions.new', compact('quiz'));
        dd("asdasjhd jash d");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( quiz $quiz,Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required',

            'option1' => 'required',
            'option2' => 'required',

        ]);


        $question = new Question();
        $question->answer=$request->answer;
        $question->question=$request->question;
        $question->option1=$request->option1;
        $question->option2=$request->option2;
        $question->quiz_id=$quiz->id;
        $question->save();


        return redirect()->route('quiz.editForm', ['quiz' => $quiz->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz $quiz, Question $question)
    {
        return view('admin.pages.question.edit', compact('quiz', 'question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz $quiz,Question $question)
    {
        $answers = $question->answers()->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $question->delete();

        return redirect()->route('quiz.editForm', ['quiz' => $quiz->id])->with('status', 'Question Deleted');

    }
    public function editStore(Quiz $quiz, Question $question, Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',

        ]);

        $question = Question::findOrFail($question->id);
        $question->update([
            'answer'=>$request->answer,
            'question'=>$request->question,
            'option1'=>$request->option1,
            'option2'=>$request->option2,
        ]);

        return redirect()->route('quiz.editForm', ['quiz' => $quiz->id]);
    }

    public function redirect(quiz $quiz)
    {
      return view('admin.pages.question.new', compact('quiz'));


    }

}
