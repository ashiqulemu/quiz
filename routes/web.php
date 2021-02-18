<?php
use Illuminate\Contracts\Session\Session;


    Route::redirect('/home', '/user-home')->name('home');

   
    Route::middleware(['auth'])->group(function () {

      
        Route::get('/quiz-home', 'UserHomeController@quizhome');
        Route::get('/next-quiz', 'UserHomeController@nextquizhome');
        Route::get('/quiz-edit', 'QuizTestController@quizedit');
        Route::get('/quiz/edit/{id}', 'QuizTestController@editquiz');
        Route::post('/quiz-update/{id}', 'QuizTestController@quizupdate');
        Route::get('/quiz-user-details/my-information','UserHomeController@qshow');
        Route::get('/quiz-user-details/qsettings', 'UserHomeController@qsettings');
        Route::post('/quiz-user-details/qupdate', 'UserHomeController@qupdateInfo');
        Route::get('/quiz-user-details/referral', 'UserHomeController@qreferral');
        Route::get('/quiz-user-details/referral-friend', 'UserHomeController@qreferralFriend');
        Route::post('/quiz-user-details/referral-send-email', 'UserHomeController@qreferralSendEmail');
        Route::get('/quiz-user-details/change-password', 'UserHomeController@qchangePassword');
        Route::post('/quiz-user-details/update-password', 'UserHomeController@qupdatePassword');
        


        Route::post('/quiz-answer', 'QuizTestController@registeredQuiz');
        Route::post('/next-quiz-answer', 'QuizTestController@nextregisteredQuiz');
        Route::get('/quiz-result', 'PrizeController@userResult');
        
    });

    Route::get('/how-it-works', function () {
        return view('site.pages.partials.how-it-works');
    });

    

    Route::get('/privacy-policy', function () {
        return view('site.conditions.privacy-policy');
    });

    Route::get('/terms-and-conditions', function () {
        return view('site.conditions.terms-and-conditions');
    });

    Route::get('/about', function () {
        return view('site.pages.about');
    });

    Route::get('/faq', function () {
        return view('site.pages.partials.FAQ');
    });
    Route::get('/contact', function () {
        return view('site.pages.partials.contact');
    });

    Route::get('/forget-password', function () {
        return view('site.login.login-partitial.forget-password');
    });




    Route::get('/quiz-test','QuizTestController@test' )->name('quiz.test');
    Route::get('/quiz-login','QuizTestController@log');
    Route::post('/quiz-login','QuizTestController@quizlog' );
    Route::get('/next-quiz-login','QuizTestController@nextlog');
    Route::post('/next-quiz-login','QuizTestController@nextquizlog' );
    Route::post('/quiz-save','QuizTestController@save' );
    Route::post('/quiz-register','QuizTestController@quizregister' );
    Route::post('/next-quiz-register','QuizTestController@nextquizregister' );
    Route::post('/header/fblogin','QuizTestController@headerfblogin' );


    Route::get('/', 'HomeDataController@land');
    Route::get('/quiz-start', 'HomeDataController@quizland');
    Route::get('/quiz-next', 'HomeDataController@next');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
