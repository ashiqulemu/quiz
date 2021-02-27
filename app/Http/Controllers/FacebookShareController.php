<?php

namespace App\Http\Controllers;

use App\FacebookShare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class FacebookShareController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FacebookShare  $facebookShare
     * @return \Illuminate\Http\Response
     */
    public function show(FacebookShare $facebookShare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FacebookShare  $facebookShare
     * @return \Illuminate\Http\Response
     */
    public function edit(FacebookShare $facebookShare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FacebookShare  $facebookShare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacebookShare $facebookShare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FacebookShare  $facebookShare
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacebookShare $facebookShare)
    {
        //
    }

    public function addcredit()
    {

        $user =auth()->user()->id;
        $countPost=FacebookShare :: where('user_id',$user  )
            ->whereDate('created_at', '>=', date('Y-m-d'))
            ->count();
        if($countPost<1) {
            $client = new FacebookShare;
            $client->user_id = $user;
            $client->save();

            $totalCredit=DB::table('users')
                ->select('credit_balance')
                ->where('id',$user)
                ->first();

            User::where('id', $user)->update([
                'credit_balance' => $totalCredit->credit_balance+100
            ]);

            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
