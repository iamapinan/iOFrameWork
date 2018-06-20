<?php
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {
    $this->get('/test', function () {
        echo json(this());
    });

    $this->get('courses/{id}', function($id){

        // echo $id ;/
        $db = new dbClient() ;
        $res = $db->select("tb7_testing", ['*'], [
            'tb4_course_f4_id[=]' => $id
        ]);

        echo json($res) ;
    });

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