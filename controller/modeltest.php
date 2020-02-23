<?php
    include('../model/Classes/ConnectDb.php');
    include('../model/Classes/User.php');
    include('../model/Classes/GradeRecord.php');
    include('../model/Classes/QuarterRecord.php');

	$users = new User();
	$grade_records = new GradeRecord();
	$quarter_records = new QuarterRecord();

    $name = 'reuk';
    $user_id = 1;
    $quarter = 4;
    $year = 2019;
    if ($users->isUserExist($name) == 0){
        // create user 
        $user_id = $users->addUser($name);
        $q_exist = $quarter_records->isQuarterExist($user_id, $quarter, $year);
        if( $q_exist == 0 ){
            // add quarter and create records
            $user_id = $quarter_records->addQuarter($user_id, $quarter, $year);
            $quarter_id = $grade_records->addGrade($user_id, $quarter_id, $grade, $last_grade_cat);
        } else {
            echo 'quarter already exist on user';
        }
    } else {
        // Get User id 
        $user_id = $users->getUserId($name) ;
        $q_exist = $quarter_records->isQuarterExist($user_id, $quarter, $year);

        if( $q_exist == 0 ){
            // add quarter and create records
            $quarter_id = $quarter_records->addQuarter($user_id, $quarter, $year);
            $quarter_id = $grade_records->addGrade($user_id, $quarter_id, $grade, $last_grade_cat);

        } else {
            // $_SESSION["error"] = 'Quarter ' . $quarter_num . ' for ' . $name .'is already uploaded and exist on records';
            // header('location: ../views/user.php');
            // exit;
        }
    } 
   
   

?>

