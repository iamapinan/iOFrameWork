<?php
namespace App\Controllers;

class CourseController {

    public function __construct() {

    }

    public function submitCourse($c_id){
        $db = new \App\DbClient() ;
        $db->update('course_register',[
            'status'=> 'done'
        ],[
            'id' => $id 
        ]);
        $select = $db->select('course_register', '*',[
            'id' => $id
        ]);
        echo json( encap_data( ['total_score' => $select[0]['total_score']]) );
    }

    /**
     * send answer
     * 
     * @param integer $answer
     * 
     * @return string json_encode
     */
    public function sendAnswer($c_id, $test_id){
        $req = request() ;
        $db = new \App\DbClient() ;
        
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
    }
    
    /**
     * regis course
     * 
     * @param integer $user_id
     * @param integer $course_id
     * 
     * @return string json_encode
     */
    public function registerCourse(){
        $req = request() ;
        $db = new \App\DbClient() ;
        $insert_param = [
            'user_id' => $req['user_id'] ,
            'course_id' => $req['course_id'] ,
        ];
        $db->insert('course_register', $insert_param);
        $res = null ;
        echo json( encap_data($res)) ;
    }
    
}