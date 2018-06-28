<?php
    $tables = [
        'courses' => 'tb4_course',
        'testing' => 'tb7_testing'
    ];
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {

    $this->post('courses', 'App\Controllers\CourseController@registerCourse');
    $this->put('courses/?/testing/?', 'App\Controllers\CourseController@sendAnswer');
    // get courses regitered by user_id 
    $this->get('users/?/courses', 'App\Controllers\UserController@getCoursebyUserId');
    // end course
    $this->put('courses/{id}/submit', 'App\Controllers\CourseController@submitCourse'); 
    $this->post('/addStudent', 'App\Controllers\UserController@addStudent');
    $this->get('/userInfo/?', 'App\Controllers\UserController@userInfo');
    $this->post('/change_password', 'App\Controllers\UserController@changePassword');
    $this->get('/userInfo/student/?', 'App\Controllers\UserController@myStudent');
    $this->controller('/authen', 'App\Controllers\AuthenControllers');
    $this->controller('/license', 'App\Controllers\KeyControllers');
    $this->controller('/grade', 'App\Controllers\GradeControllers');
    $this->controller('/chat', 'App\Controllers\ChatControllers');
    $this->controller('/article', 'App\Controllers\ArticleControllers');

});