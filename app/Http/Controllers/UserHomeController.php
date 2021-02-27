<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AutoBid;
use App\Bid;
use App\Contact;
use App\Http\Traits\Districts;
use App\Payment;
use App\Product;
use App\Sales;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\quizhead;
use App\Prize;
use App\FacebookShare;
use App\fbvideo;

class UserHomeController extends Controller
{
    use  Districts;
    public function index()
    {
        if(!auth()->user()){
            return redirect('/login');
        }
        $auctionList = Auction::with('product.category', 'medias', 'slots', 'bids.user')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();

        $productList = Product::with('category', 'medias')
            ->whereStatus(1)
            ->where('quantity','>', 0)
            ->latest()
            ->take(15)
            ->get();
        $closedAuctions = Auction::with('product.category', 'medias')
            ->whereIsClosed(1)
            ->latest()
            ->take(10)
            ->get();

        $upCommingAuction = Auction::with('product.category', 'medias')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()
            ->get();
        $id = auth()->user()->id;

        $countPost=FacebookShare :: where('user_id',$id  )
            ->whereDate('created_at', '>=', date('Y-m-d'))
            ->count();


        return view('site.login.index', [
            'auctionList'       => $auctionList,
            'productList'       => $productList,
            'closedAuctions'    => $closedAuctions,
            'upCommingAuction'  => $upCommingAuction,
            'countPost'         => $countPost,

        ]);

    }

    public function updateInfo(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|unique:users,email,'.auth()->user()->id,
        ]);
        $user = User::find(auth()->user()->id);
        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'mobile'      => $request->mobile,
            'news_letter' => $request->news_letter ? true : false,
        ]);
        Contact::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'city'      => $request->city,
                'post_code' => $request->post_code,
                'district'  => "null",
            ]

        );
        return redirect('/user-details');
    }
    public function qupdateInfo(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|unique:users,email,'.auth()->user()->id,
        ]);
        $user = User::find(auth()->user()->id);
        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'mobile'      => $request->mobile,
            'news_letter' => $request->news_letter ? true : false,
        ]);
        Contact::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'city'      => $request->city,
                'post_code' => $request->post_code,
                'district'  => "null",
            ]

        );
        return redirect('/quiz-user-details');
    }
    public  function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'repeat_password'  => 'required|same:new_password',
        ]);
        $current_password = Auth::User()->password;
        if(Hash::check($request['old_password'], $current_password))
        {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request['new_password']);;
            $obj_user->save();
            return redirect('/user-details/my-information')->with([
                'type'      => 'success',
                'message'   => 'Password Change successfully'
            ]);;
        } else {
            return redirect()->back()->with([
                'type'      => 'error',
                'message'   => 'Current password did not match please try again'
            ]);
        }

    }

    public  function qupdatePassword(Request $request) {
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'repeat_password'  => 'required|same:new_password',
        ]);
        $current_password = Auth::User()->password;
        if(Hash::check($request['old_password'], $current_password))
        {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request['new_password']);;
            $obj_user->save();
            return redirect('/quiz-user-details/my-information')->with([
                'type'      => 'success',
                'message'   => 'Password Change successfully'
            ]);
        } else {
            return redirect()->back()->with([
                'type'      => 'error',
                'message'   => 'Current password did not match please try again'
            ]);;
        }

    }


    public function show()
    {
        return view('site.login.user.user');
    }
    public function qshow()
    {
        return view('site.login.user.quiz.user');
    }


    public function statistic()
    {
        $bids =Bid::whereUserId(auth()->user()->id)->groupBy('auction_id')->get();
        $participate = count($bids);
        $wonAuctions = Auction::with('bids.user')->whereHas('bids',function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('is_closed', 1)->get();
        $creditUsed = Bid::whereUserId(auth()->user()->id)->sum('cost_bid');
        $creditBought = Payment::whereUserId(auth()->user()->id)->sum('credit');
        $creditLeft = $creditBought - $creditUsed;

        return view('site.login.user.partial.statistic', [
            'participate'   => $participate,
            'wonAuctions'   => $wonAuctions,
            'creditUsed'    => $creditUsed,
            'creditBought'  => $creditBought,
            'creditLeft'    => $creditLeft,
        ]);
    }
    public function settings()
    {
//        $districts = $this->getDistricts();
        return view('site.login.user.partial.editSetting');
    }

    public function qsettings()
    {
//        $districts = $this->getDistricts();
        return view('site.login.user.quiz.editSetting');
    }

    public function referral()
    {
        $referCount = User::whereReferralId(auth()->user()->id)->count();
        return view('site.login.user.partial.refferal', ['referCount' => $referCount]);
    }
    public function qreferral()
    {
        $referCount = User::whereReferralId(auth()->user()->id)->count();
        return view('site.login.user.quiz.refferal', ['referCount' => $referCount]);
    }
    public function referralFriend()
    {
        return view('site.login.user.partial.refferal-email-send');
    }
    public function qreferralFriend()
    {
        return view('site.login.user.quiz.refferal-email-send');
    }
    public function referralSendEmail(Request $request)
    {
        $emailData = [
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id
        ];
        $this->sendEmail('email.email-referral', $emailData,auth()->user()->name.' sent invitation to join with us',  $request->input('email'));

        $id=auth()->user()->id;
        $amount=(float)auth()->user()->credit_balance + 100;
        $credit=User::find($id);
        $credit->credit_blalnce=$amount;
        $credit->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Invitation sent successfully'
        ]);
    }
    public function qreferralSendEmail(Request $request)
    {
        $emailData = [
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id
        ];
        $id=auth()->user()->id;
        $amount=(float)auth()->user()->credit_balance + 100;
        $credit=User::find($id);
        $credit->credit_blalnce=$amount;
        $credit->save();

        $this->sendEmail('email.email-referral', $emailData,auth()->user()->name.' sent invitation to join with us',  $request->input('email'));

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Invitation sent successfully'
        ]);
    }
    public function changePassword()
    {
        return view('site.login.user.partial.change-password');
    }
    public function qchangePassword()
    {
        return view('site.login.user.quiz.change-password');
    }
    public function allOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.all-order', [
            'orders' => $orders
        ]);
    }
    public function shipmentOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('Shipped')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.shipment-order', [
            'orders' => $orders
        ]);
    }
    public function completedOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('Delivered')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.completed-order', [
            'orders' => $orders
        ]);
    }
    public function cancelOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('cancel')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.cancel-order', [
            'orders' => $orders
        ]);
    }
    public function biddingHistory()
    {
        $bids = Bid::with('auction')
            ->whereUserId(auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(20);
        return view('site.login.user.partial.history', ['bids' => $bids]);
    }
    public function creditBuyingHistory()
    {
        $creditHistory = Payment::wherePaymentableType('App\Package')
            ->whereUserId(auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(20);
        return view('site.login.user.partial.credit-buying-history',['creditHistory' => $creditHistory]);
    }

    public function orderCancel($order_no) {
        $sales = Sales::whereOrderNo($order_no)->get();
        if($checkAccessResutl =  $this->checkAccessOfUser($sales[0]->user_id, $sales[0]->order_status)) return $checkAccessResutl;
        foreach ($sales as $sale) {
            $sale->update(['order_status' => 'cancel']);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Your order canceled successfully.'
        ]);

    }

    public function checkAccessOfUser($userId , $status) {

        if($userId != auth()->user()->id) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not valid person to do that'
            ]);
        }
        if ($status != 'pending') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Only cash on delivery and pending status can cancelable'
            ]);
        }

    }
    public function quizhome()
    {

        $id = auth()->user()->id;

        $quiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type','=','First')
            ->where('status',1)
            ->get();

        $countPost=FacebookShare :: where('user_id',$id  )
            ->whereDate('created_at', '>=', date('Y-m-d'))
            ->count();

        $quizheads=DB::table('quizheads')
                    ->select('*')
                    ->get();



        $prize=Prize::all();
        $video=DB::table('fbvideos')
            ->select('name')
            ->where('status','=','Publish')
            ->get();


//        $prize=DB::table('prizes')
//            ->select('score','gift')
//            ->get();


        if(sizeof($quiz)>0)
        {

            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $quiz[0]->id)
                ->get();


//            return view('site.login.login-partial.loggedin_quiz', ['quiz' => $quiz, 'question' => $question]);

            return view('site.login.login-partitial.quiz.quizindex',[

                'countPost'=>$countPost,
                'quiz'=>$quiz,
                'question'=>$question,
                'quizhead'=>$quizheads,
                'prize'=>$prize,
                'video'=>$video,
            ]);
        }
        else {

            $message="No quiz available";
            return view('site.login.login-partitial.quiz.quizindex', ['msg' => $message]);

        }

        }
    public function nextquizhome()
    {

        $id = auth()->user()->id;

        $quiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type','=','Next')
            ->where('status',1)
            ->get();

        $countPost=FacebookShare :: where('user_id',$id  )
            ->whereDate('created_at', '>=', date('Y-m-d'))
            ->count();
        $quizheads=DB::table('quizheads')
            ->select('*')
            ->get();

        $prize=Prize::all();


//        $prize=DB::table('prizes')
//            ->select('score','gift')
//            ->get();


        if(sizeof($quiz)>0)
        {

            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $quiz[0]->id)
                ->get();


//            return view('site.login.login-partial.loggedin_quiz', ['quiz' => $quiz, 'question' => $question]);

        }
        else {

            $message="No quiz available";
            return view('site.login.login-partitial.quiz.nextquizindex', ['msg' => $message]);

        }


        return view('site.login.login-partitial.quiz.nextquizindex',[

            'countPost'=>$countPost,
            'quiz'=>$quiz,
            'question'=>$question,
            'quizhead'=>$quizheads,
            'prize'=>$prize,

        ]);

    }

    public function info()
    {

       return view('site.login.login-partitial.quiz.quizafter');
    }


    public function quizedit()
    {

        dd("working on progress. to go back back press back button from top");
    }




}
