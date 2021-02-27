<?php
Route::middleware(['init'])->group(function () {
Auth::routes();
Route::middleware(['checkLogin'])->group(function () {
   
});
Route::middleware(['adminAuth'])->group(function () {
    Route::get('/dashboard', 'AdminDashboardController@dashboard');
   
    Route::resource('cms','CmsController');
  
    Route::get('/change-password','AdminAuthController@changePassword');
    Route::post('/update-password','AdminAuthController@UpdatePassword');


    Route::get('/quiz', 'AdminDashboardController@quizindex');
    Route::post('/create-quiz', 'QuizController@create')->name('quiz.create');
    Route::get('/edit-quiz/{quiz}', 'QuizController@edit')->name('quiz.editForm');
    Route::delete('/delete-quiz/{quiz}', 'QuizController@destroy')->name('quiz.delete');
    Route::post('/edit-quiz/{quiz}', 'QuizController@store')->name('quiz.edit');


    Route::get('/question/{quiz}', 'QuestionController@redirect')->name('question.create');
    Route::post('/create-question/{quiz}', 'QuestionController@store')->name('question.store');
    Route::get('/edit-quiz/{quiz}/question/{question}', 'QuestionController@edit')->name('question.editForm');
    Route::post('/edit-quiz/{quiz}/question/{question}', 'QuestionController@editStore')->name('question.edit');
    Route::delete('/delete-quiz/{quiz}/question/{question}', 'QuestionController@destroy')->name('question.delete');

    Route::post('/create-prize', 'PrizeController@store')->name('create.prize');
    Route::post('/prize-update/{prize}', 'PrizeController@prizeupdates')->name('prize.prizeupdate');
    Route::delete('/prize-delete/{prize}', 'PrizeController@destroy')->name('prize.delete');

    Route::get('/publish-result/{id}', 'PrizeController@publishresult')->name('publish.result');
    Route::resource('quizhead','QuizheadController');
    Route::get('/withdraw-request', 'WithdrawlController@adminwithdrawl');
   
    Route::get('/fb-video', 'FbvideoController@index');
    Route::post('/savefb-video', 'FbvideoController@store');
    Route::get('/showfb-video', 'FbvideoController@show');
    Route::get('/publish/{id}', 'FbvideoController@publish');

    Route::delete('/video-delete/{id}', 'FbvideoController@destroy');
});

});

Route::get('login', 'AdminAuthController@login');