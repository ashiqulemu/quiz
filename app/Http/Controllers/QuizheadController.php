<?php

namespace App\Http\Controllers;

use App\quizhead;
use Illuminate\Http\Request;

class QuizheadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $qheads=quizhead::all();
        return view('admin.pages.quiz.quizhead-show',['qhead'=>$qheads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.quiz.quizhead');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qhead=new quizhead();
        $qhead->first_header=request('first_header');
        $qhead->second_header=request('second_header');
        $qhead->save();

//     return redirect()->back()
        return redirect('/admin/quizhead/create')
           ->with(['type'=>'success','message'=>'Header created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\quizhead  $quizhead
     * @return \Illuminate\Http\Response
     */
    public function show(quizhead $quizhead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\quizhead  $quizhead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $qheads=quizhead::find($id);
        return view('admin.pages.quiz.quizhead-edit',['qhead'=>$qheads]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\quizhead  $quizhead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $head=quizhead::find($id);

        $head->update([
            'first_header'=>$request->first_header,
            'second_header'=>$request->second_header,

        ]);


        return redirect('/admin/quizhead')
            ->with(['type'=>'success','message'=>'Header Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quizhead  $quizhead
     * @return \Illuminate\Http\Response
     */
    public function destroy(quizhead $quizhead)
    {
        $quizhead->delete();
        return back()
            ->with(['type'=>'success','message'=>'Package Deleted Successfully']);
    }
}
