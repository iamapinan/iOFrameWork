<?php
    $tables = [
        'courses' => 'tb4_course',
        'testing' => 'tb7_testing'
    ];
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {

    $this->get('/test', function () {
        echo json(this());
    });
    
    /**
     * regis course
     * 
     * @param integer $user_id
     * @param integer $course_id
     * 
     * @return string json_encode
     */
    $this->post('courses', function(){

        $req = request() ;
        $db = new App\DbClient() ;
        $insert_param = [
            'user_id' => $req['user_id'] ,
            'course_id' => $req['course_id'] ,
        ];
        $db->insert('course_register', $insert_param);
        $res = null ;
        echo json( encap_data($res)) ;
    });

    /**
     * send answer
     * 
     * @param integer $answer
     * 
     * @return string json_encode
     */
    $this->put('courses/?/testing/?', function($c_id, $test_id){
        $req = request() ;
        $db = new App\DbClient() ;
        
        $is_correct = $req['is_correct'];
        // prepare data
        $insert_data = [
            'user_course_id' => $c_id,	
            'test_id' => $test_id,
            'answer' => $req['answer'],	
            'is_correct' => $is_correct
        ];
        // create history testing
        $d = $db->insert('user_course_test', $insert_data);
        if ($is_correct) {
            // update total score 
            $db->update('course_register',[
                'total_score[+]' => 1
            ],[
                'id' => $c_id
            ]);
        }
        echo json( encap_data() );
    });
    
    // get courses regitered by user_id 
    $this->get('users/?/courses', function($user_id){
        $db = new App\DbClient ;
        $result = $db->select("course_register", '*', [
            'user_id' => $user_id
        ]);
        $group_by = array_key_by($result, 'course_id');
        $data = [
            'all' => $result,
            'group_by_course_id' => $group_by, 
        ];
        echo json(encap_data($data));
    });

    $this->put('courses/{id}/submit', function($id){

        $db = new App\DbClient() ;
        $db->update('course_register',[
            'status'=> 'done'
        ],[
            'id' => $id 
        ]);
        $select = $db->select('course_register', '*',[
            'id' => $id
        ]);
        echo json( encap_data( ['total_score' => $select[0]['total_score']]) );
        
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
    $this->controller('/authen', 'App\Controllers\AuthenControllers');

});