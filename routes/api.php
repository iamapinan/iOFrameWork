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

    $this->controller('/authen', 'App\Controllers\AuthenControllers');
    $this->controller('/license', 'App\Controllers\KeyControllers');
    $this->controller('/grade', 'App\Controllers\GradeControllers');
    
    $this->group('u', function(){
        $this->get('info', function(){
            echo json_encode([
            
                'first_name' => 'Sorsssa',
                'last_name' => 'Aoi',
                'school_name' => 'IO Tech Hi School',
                'teacher_name' => 'ครูมาวิน ดึงออกที'
                
            ]);
        });
    });
});