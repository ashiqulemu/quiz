<?php
use Illuminate\Contracts\Session\Session;

Route::middleware(['init'])->group(function () {
    Route::redirect('/home', '/user-home')->name('home');

 Route::middleware(['auth'])->group(function () {

        Route::get('/user-home', 'UserHomeController@index');
        Route::get('/quiz-home', 'UserHomeController@quizhome');
        Route::get('/next-quiz', 'UserHomeController@nextquizhome');

        Route::get('/quiz-edit', 'QuizTestController@quizedit');
        Route::get('/quiz/edit/{id}', 'QuizTestController@editquiz');
        Route::post('/quiz-update/{id}', 'QuizTestController@quizupdate');

        Route::get('/info-home', 'UserHomeController@info');
        Route::redirect('/user-details','/user-details/my-information');
       
         Route::get('/quiz-user-details/my-information','UserHomeController@qshow');
        Route::get('/quiz-user-details/qsettings', 'UserHomeController@qsettings');
        Route::post('/quiz-user-details/qupdate', 'UserHomeController@qupdateInfo');
        Route::get('/quiz-user-details/referral', 'UserHomeController@qreferral');
        Route::get('/quiz-user-details/referral-friend', 'UserHomeController@qreferralFriend');
        Route::post('/quiz-user-details/referral-send-email', 'UserHomeController@qreferralSendEmail');
        Route::get('/quiz-user-details/change-password', 'UserHomeController@qchangePassword');
        Route::post('/quiz-user-details/update-password', 'UserHomeController@qupdatePassword');
        Route::get('/request', 'WithdrawlController@index');
        Route::post('/request-payment', 'WithdrawlController@store');
        Route::get('/edit-request', 'WithdrawlController@edit');
        Route::post('/update-request/{id}', 'WithdrawlController@update');
        Route::get('/withdrawl-history', 'WithdrawlController@show');


        Route::post('/quiz-answer', 'QuizTestController@registeredQuiz');
        Route::post('/next-quiz-answer', 'QuizTestController@nextregisteredQuiz');
        Route::get('/quiz-result', 'PrizeController@userResult');
       
    });
    Route::get('auth/facebook', 'Auth\LoginController@redirect');
    Route::get('auth/facebook/callback', 'Auth\LoginController@callback');
    Route::post('/count/fb', 'FacebookShareController@addcredit');
    Route::get('/commercial-quiz/{id}', 'HomeDataController@findQuiz');
   
    Route::get('/promotion-video','FbvideoController@promo' );

    Route::get('/privacy-policy', function () {
        return view('site.conditions.privacy-policy');
    });

    Route::get('/terms-and-conditions', function () {
        return view('site.conditions.terms-and-conditions');
    });

   Route::get('/forget-password', function () {
        return view('site.login.login-partitial.forget-password');
    });

    Route::get('/referral', function () {
        return view('site.pages.referral.referral');
    });

    Route::get('/quiz-test','QuizTestController@test' )->name('quiz.test');
    Route::post('/quiz-save','QuizTestController@save' );
    Route::post('/header/fblogin','QuizTestController@headerfblogin' );


    Route::get('/', 'HomeDataController@land');
    Route::get('/quiz-start', 'HomeDataController@quizland');
    Route::post('/quiz-answer', 'QuizTestController@registeredQuiz');
});

//Route::get('facebook', function () {
//    return view('facebook');
//});
//Route::get('auth/facebook', 'Auth\LoginController@redirect');
//Route::get('auth/facebook/callback', 'Auth\LoginController@callback');

