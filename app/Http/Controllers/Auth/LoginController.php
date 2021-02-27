<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use phpDocumentor\Reflection\Types\Null_;
use App\quiz;
use App\Question;
use App\Score;
use Illuminate\Session;
use App\quizAnswer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user-home';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    protected function authenticated(Request $request, $user)
    {
        if(!$user->is_active){
            Auth::logout();
            return redirect('/');
        }
        if(($user->role === 'admin' || $user->role === 'sub-admin') && $request->input('from') == 'ad'){
            return redirect('/admin/dashboard');


        }else if($user->role === 'user' && $request->input('from') == 'st'){
            Cart::merge(auth()->user()->id);
            return redirect('/user-home');

        }else if($user->role === 'user' && $request->input('from') == 'quiz') {

            return redirect('/quiz-home');
        }else {
            Auth::logout();
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function eraseCartItem($identifier) {
        $instanceItem = DB::table('shoppingcart')->whereIdentifier($identifier)->first();
        if($instanceItem){
            DB::table('shoppingcart')->whereIdentifier($identifier)->delete();
        }

    }

  

    public function redirect()
    {

          return Socialite::driver('facebook')->redirect();

    }
    public function callback()
    {
        try {
            $fbuser = Socialite::driver('facebook')->user();
            $user=DB::table('users')
                ->select('id')
                ->where('email',$input['email'] = $fbuser->getEmail())
                ->first();
                $input['name'] = $fbuser->getName();
                $input['email'] = $fbuser->getEmail();
//              $input['provider'] = $provider;
                $input['facebook'] = $fbuser->getId();

            if($user==Null)
            {

                $user = User::create([
                    'name' => $input['name'],
                    'username' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['facebook']),

                    'credit_balance' => 1,
                    'singUp_credit' => 1,

                ]);

                Auth::loginUsingId($user->id);

                $ruser = auth()->user()->id;
                $abc = session()->get('answer');
                if(isset($abc)) {

                    $radio = $abc->radio;
                    $abcd = $abc->id;
                    $quizid=$abc->quizid;
                    $check = DB::table('answers')
                        ->join('questions', 'answers.question_id', '=', 'questions.id')
                        ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                        ->where('answers.user_id', '=', $ruser)
                        ->where('quizzes.quiz_id', '=', $quizid)
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
                        quizanswer()->session()->flash('answer');
                        return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
                    } else {
                        session()->flash('answer');
                        return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
                    }
                }
                    else{ return redirect($this->redirectTo);}




            }
            else {

                Auth::loginUsingId($user->id);
                $ruser = auth()->user()->id;
                $abc = session()->get('answer');
                if (isset($abc)) {
                    $radio = $abc->radio;
                    $abcd = $abc->id;
                    $quizid=$abc->quizid;
                    $check = DB::table('answers')
                             ->join('questions', 'answers.question_id', '=', 'questions.id')
                             ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                             ->where('answers.user_id', '=', $ruser)
                             ->where('quizzes.quiz_id', '=', $quizid)
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
                        quizanswer()->session()->flash('answer');
                        return redirect('/info-home')->withErrors(['If you win you will be notified as soon as the result will be published']);
                    } else {
                        quizanswer()->session()->flash('answer');
                        return redirect('/info-home')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
                    }
                } else {
                    return redirect($this->redirectTo);

                }
            }
//           $authUser = $this->findOrCreate($input);
//            Auth::loginUsingId($authUser->id);

        }
        catch (Exception $e) {

            return redirect('/');

        }
    }


}
