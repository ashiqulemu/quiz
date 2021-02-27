<?php

namespace App\Http\Controllers;

use App\withdrawl;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class WithdrawlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.login.user.quiz.withdrawl.withdrawl');
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

      $check=DB::table('withdrawls')
          ->select('*')
          ->where('user_id','=',auth()->user()->id)
          ->where('status','=','pending')
          ->count();


      if($check==0 || $check==Null) {

          $amount = (int)$request->amount;

          $dollar = $amount * 100;


          if (($dollar) > (int)auth()->user()->credit_balance ) {
              return redirect()->back()->with([
                  'type' => 'error',
                  'message' => 'You do not have sufficient amount. Please check your amount input.'
              ]);
          } else {
              $input = new withdrawl();
              $input->user_id = auth()->user()->id;
              $input->user_name = auth()->user()->username;
              $input->email = $request->email;
              $input->coins = $dollar;
              $input->amount = $amount;
              $input->status = "Pending";
              $input->save();
              return redirect()->back()->with([
                  'type' => 'success',
                  'message' => 'Your Withdrawl request has been submitted successfully.'
              ]);

          }
      }else{
          return redirect()->back()->with([
              'type' => 'error',
              'message' => 'You have already Pending withdraw request.'
          ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\withdrawl  $withdrawl
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $shows=DB::table('withdrawls')
                ->select('*')
                ->where('user_id','=',auth()->user()->id)
                ->orderBy('id','desc')
                 ->get();

        return view('site.login.user.quiz.withdrawl.history',['history'=>$shows]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\withdrawl  $withdrawl
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $edit=DB::table('withdrawls')
            ->select('*')
            ->where('user_id','=',auth()->user()->id)
            ->where('status','=','Pending')
            ->get();

        if(sizeof($edit)<1)
        {
            $message="You don not have any request to edit !!";
            return view('site.login.user.quiz.withdrawl.edit',['message'=>$message]);
        }
        else {
            return view('site.login.user.quiz.withdrawl.edit', ['edit' => $edit]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\withdrawl  $withdrawl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $amount = (int)$request->amount;

        $dollar = $amount * 100;
        if($dollar>auth()->user()->credit_balance)
        {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You do not have sufficient amount. Please check your amount input.'
            ]);
        }
        else {

                $update=withdrawl::find($id);
                $update->email=$request->email;
                $update->coins=(int)$request->amount * 100;
                $update->amount=(int)$request->amount;
                $update->save();

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Your request has been Updated Successfully!!.'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\withdrawl  $withdrawl
     * @return \Illuminate\Http\Response
     */
    public function destroy(withdrawl $withdrawl)
    {
        //
    }


    public function adminwithdrawl()
    {
        if(auth()->user()->role==="admin" ||auth()->user()->role==="sub-admin") {
            $shows = DB::table('withdrawls')
                ->select('*')
                ->where('status', '=', 'Pending')
                ->orderBy('id', 'desc')
                ->get();

            return view('admin.pages.quiz.showwithdrawl', ['history' => $shows]);

        }
        else{
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not Admin'
            ]);
        }

    }
    public function payment($id)
    {   if(auth()->user()->role==="admin" ||auth()->user()->role==="sub-admin")
            {
               $pay=withdrawl::find((int)$id);
               $uid=$pay->user_id;
               $coin=$pay->coins;
               $pay->status="Paid";
               $pay->save();
               $user= User::find($uid);
               $total=$user->credit_balance;
               $user->credit_balance=$total-$coin;
                $user->save();
                return redirect()->back()->with([
                    'type' => 'success',
                    'message' => 'The payment has paid Successfully!!'
                ]);

            }
    else{
        return redirect()->back()->with([
            'type' => 'error',
            'message' => 'You are not Admin'
        ]);
    }




    }

}
