<?php


Route::get('/', function () {
    return view('marketing');
});

Route::get('lessons/{name}/{page?}', 'LessonController@show');
