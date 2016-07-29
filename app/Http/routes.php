<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where   all of the routes are registered in this  application.
|--------------------------------------------------------------------------
|
*/



Route::group(['middleware' => ['web']], function () {
    //
    Route::auth();


    Route::get('/home', 'HomeController@index');


        //route for profile page
    Route::get('profile/{username}','ProfileController@display');
    Route::get('profile/display/topics','ProfileController@my_topics');
    Route::get('profile/update/update_online_info','ProfileController@update_online_info');
    Route::get('profile/{profile_name}/get_online_info','ProfileController@get_online_info');
    Route::get('profile/combined/rank_list','ProfileController@rank_list');
    Route::get('profile/topic/delete/{id}','ProfileController@delete');
    Route::post('profile/{username}/upload','ProfileController@upload_profile');
    Route::post('cover/{username}/upload','ProfileController@upload_cover');
    
   // topics realted routes
    Route::get('/topics','TopicController@display_all');
    Route::get('/topics/search/{search_input}','TopicController@search');

    //route for getting particular topic
    Route::get('/topics/{topic_name}','TopicController@display');
    Route::get('/topics/{topic}/like','TopicController@like');
    //route for playing the topic

    Route::get('/update_user_info/{current_opponent}/{opponent_score}','GameController@update_user_info');
    Route::get('/topics/{topic_name}/play','GameController@play');
    
    // Route::get('/topics/{topic_name}/playing','GameController@playing');
    
    Route::get('/topics/{topic_name}/searching','GameController@searching');

    /// route for creating topic

    Route::get('create/topic','TopicController@create');
    Route::get('create/question','TopicController@create_question');
    

    Route::post('/submit/questions','TopicController@submit_questions');
    Route::get('add_new_topic',function()
         {
            return "admin create here";
         });


    // game related routes
    Route::get('/game/validate_ans/{question_id}/{selected_option}/{time_remaining}','GameController@validate_ans');

    Route::get('/game/display_scores','GameController@display_scores');
    Route::get('/game/user_left_before_starting','GameController@user_left_before_starting');
    Route::get('/game/result','GameController@result');

     // route for home page
    Route::get('/','HomeController@index');

    Route::get('/admin','AdminController@home');
    Route::get('/admin/{topic}/{category}/{username}/view','AdminController@view_questions');

    Route::get('/admin/add_topic/{topic}/{username}','AdminController@add_topic');
    Route::get('/admin/delete_topic/{topic}/{username}','AdminController@delete_topic');
    
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    
});
