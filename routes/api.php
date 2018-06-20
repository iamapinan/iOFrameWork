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

    $this->get('testtt' , function(){
        $db = new App\DbClient() ;

        $res = $db->select("tb7_testing", '*',[
            'tb4_course_f4_id' => 2
        ]);

        print_r( $res);
        // echo json($res) ;
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
        // use partner db
        // $questions = $db->select('tb7_testing', '*',[
        //     'AND' => [
        //         'f7_type' => 1,
        //         // 'f7_status' => 1,
        //         'tb4_course_f4_id' => $req['course_id'],
        //     ]
        // ]);
        // var_dump( $questions); 
        // $res =  [
        //     'total' => count($questions),
        //     'questions' => $questions,
        // ];
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
        
        // use partner db
        // $correct_choice = $db->select('tb7_testing', '*',[
        //     "f7_id" => $test_id
        // ]);
        $is_correct = $req['is_correct'];
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