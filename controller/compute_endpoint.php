<?php
    include('../model/Classes/ConnectDb.php');
    include('../model/Classes/User.php');
    include('../model/Classes/GradeRecord.php');
    include('../model/Classes/QuarterRecord.php');

	$users = new User();
	$grade_records = new GradeRecord();
    $quarter_records = new QuarterRecord();
    

    session_start();

    $target_file = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_DIRNAME));


    $file = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
    $content =  fread($file,filesize($_FILES["fileToUpload"]["tmp_name"]));
    fclose($file);

    $trimmed_content = trim(preg_replace('/\s\s+/', ' ', $content));
    $lenght = strlen($trimmed_content);

    // count quarter
    $last_character_index = 0;
    $quarter_count = 0;
    for($x=0; $x<$lenght; $x++){
        if($trimmed_content[$x] == ' ' || $x == $lenght-1){
            $string = substr($trimmed_content, $last_character_index, (($x == $lenght-1) ? $lenght : $x-$last_character_index)); 
            if (strtolower($string) == 'quarter'){
                $quarter_count++;
            }    
            $last_character_index = ++$x; 
        }
    }
    
    // multiple quarter is not allowed
    if ($quarter_count > 1){
        $_SESSION["error"] = "System only accept 1 Quarter at a time ";
        header('location: ../views/user.php');
        exit;
    }   

    $quarter = substr($trimmed_content, 0, 16); 
    $quarter_exploded = explode(' ', $quarter);
    // var_dump($quarter_exploded);
    if (strtolower($quarter_exploded[0]) != 'quarter'){
        $_SESSION["error"] = "Please follow the format, quarter is not valid";
        header('location: ../views/user.php');
        exit;
        // echo 'Please follow the format, quarter is not valid';
    }

    if ( ! (($quarter_exploded[1]) == '1,' || ($quarter_exploded[1]) == '2,' || ($quarter_exploded[1]) == '3,' || ($quarter_exploded[1]) == '4,')){
        $_SESSION["error"] = "Please follow the format, quarter number is not accepted";
        header('location: ../views/user.php');
        exit;
        // echo 'Please follow the format, quarter number is not accepted' . '<br>';
    }

    if ( ! (is_numeric($quarter_exploded[2]) && strlen($quarter_exploded[2]) == 4 ) ){
        $_SESSION["error"] = "Please follow the format, year format is invalid";
        header('location: ../views/user.php');
        exit;
        // echo 'Please follow the format, year is invalid' . '<br>';
    }

    $quarter_num = str_replace(",", "", ($quarter_exploded[1]));
    $year = $quarter_exploded[2];


    // if next is number substr current to the next character.
    // 1 incremental lang youl be able to determine if saving
    $records = substr($trimmed_content, 16, ($lenght-1)); 
    $lenght_rec = strlen($records);
    $ave = 0;
    $initial_index = 0;
    $saved_name = '';
    $count_user = 0;
    $uploaded_names = array();
    $records_tobeupload = array();


    for($x = 0 ; $x < $lenght_rec ; $x++) {
        // if Current loop is space and next loop is number then get the grade
        if($records[$x] == ' '  &&  strpos('1234567890', $records[$x+1]) !== false ) {
            // If space and last loop is not H,T then return error
            if (strpos('ABCDEFGIJKLMNOPQRSUVWXYZ', strtoupper($records[$x-1])) !== false) {
                $_SESSION["error"] = "Error Format, Please follow the correct format ";
                header('location: ../views/user.php');
                exit;
                // echo 'Error Format, Please follow the correct format ' . '<br>';
            }

            // Store which category of grade will fall
            if (strpos('HT', strtoupper($records[$x-1])) !== false) {
                $last_grade_cat = $records[$x-1];
               
                $last_index = $x-2;
                $gradecount_cat = 0;
                // if x is number and 2nd is letter therefore index intial set
            }

            // if current loop detetcs end of loop ahead of 2 or 1 therefore dont output 
            if ($lenght_rec-3 == $x || $lenght_rec-2 == $x || $lenght_rec-4 == $x || $lenght_rec-5 == $x ){
                // if the current loop detects the end of loop ahead of 3 then get the number
                if ($lenght_rec-3 == $x){
                    $grade = $records[$x+1] . $records[$x+2];
                    $gradecount_cat++;
                }


                if ($lenght_rec-2 == $x){
                    $grade = $records[$x+1];
                    $gradecount_cat++;
                }

                if ($lenght_rec-4 == $x){
                    $grade = $records[$x+1] . $records[$x+2] . $records[$x+3];
                    $gradecount_cat++;
                }

                if ($lenght_rec-5 == $x){
                    $_SESSION["error"] = "Invalid format, Numbers and character are needs to be seperated";
                    if (is_numeric($records[$x+4])){
                        $_SESSION["error"] = "Grade should not be more than 100";
                    }
                    header('location: ../views/user.php');
                    exit;
                }
            } else {
                // else output if and only if +1 of current loop is a number and + 2 current loop is a number
                if (strpos('1234567890', $records[$x+1]) !== false && strpos(' 1234567890', $records[$x+2]) !== false){
                    // if +3 current loop is space then grade is 2 digits 
                    if (strpos(" ", $records[$x+3]) !== false){
                        $grade = $records[$x+1] . $records[$x+2];
                        $gradecount_cat++;
                    // if +3 current loop is a number and +2 current loop is number as well then grades are 3 digits 
                    } elseif (strpos('1234567890', $records[$x+3]) !== false && strpos("1234567890", $records[$x+2]) !== false) {
                        // if +4 current loop is a number the return error as it is not accepted.
                        if ( $records[$x+4] != ' ' ){
                            $_SESSION["error"] = "Grade should not be more than 100";
                            header('location: ../views/user.php');
                            exit;
                            // echo 'Grade should not be more than 100 +4';
                        }
                        // records only 3 digit number
                        $grade = $records[$x+1] . $records[$x+2] .$records[$x+3];
                        $gradecount_cat++;
                    // if non of the condition met, then 1 digit only
                    } else {
                        $grade = $records[$x+1];
                        $gradecount_cat++;
                    }
                }
            }

            // if 2nd to the last of existing loop is a letter then that is the last name
            if (strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZ', strtoupper($records[$x-3])) !== false) {
                $name = substr($records, $initial_index, ($last_index-$initial_index));

            }

            // If grade exceeds 100 then return error
            if ($grade > 100){
                $_SESSION["error"] = "Grade should not be more than 100";
                header('location: ../views/user.php');
                exit;
                // echo 'Grade should not be more than 100s';
            }

            // Users Count 
            if($saved_name != $name){
                $saved_name = $name;
                $count_user++; 
            }

            // If users count exceeds 50
            if($count_user > 50){
                $_SESSION["error"] = "Maximum users to upload exceeds the limit. 50 is max";
                header('location: ../views/user.php');
                exit;
                // echo 'Maximum users to upload exceeds the limit. 50 is max';
            }
            
            // If users count exceeds 50
            if($gradecount_cat > 50){
                $_SESSION["error"] = 'Maximum number of ' . $last_grade_cat . ' grade to upload for ' .$name . ' exceeds the limit. 50 is max';
                header('location: ../views/user.php');
                exit;
            }

            $data = array(
                'name' => $name,
                'quarter_num' => $quarter_num,
                'year' => $year,
                'grade' => $grade,
                'last_grade_cat' => $last_grade_cat,
            );

            array_push($records_tobeupload, $data); 
        
        }

        // changing of intial index only applies if the condition is not met , conditions is if the current loop nearing of the end of loop then dont chane the initial index
        if (! ($lenght_rec-4 == $x || $lenght_rec-3 == $x || $lenght_rec-2 == $x || $lenght_rec-1 == $x) ){
            // if current loop is a number and +2 current loop is a letter therefore change the index
            if (strpos('1234567890', $records[$x]) !== false && strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZ', $records[$x+2]) !== false) {
                $initial_index = $x+2;
            }
        } 

        // Checking of formats only applies if current loop is not the last loop 
        if (! ($lenght_rec-1 == $x) ){
            // if cuurrent loop is a nnumber and +1 current loop contains letter or -1 current loop contains letter then return error. a number cannot contain letters and vice versa
            if ( (strpos('1234567890', $records[$x]) !== false && strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZ', strtoupper($records[$x+1])) !== false) || (strpos('1234567890', $records[$x]) !== false && strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZ', strtoupper($records[$x-1])) !== false)){
                $_SESSION["error"] = 'Error format. Either Grade or names are incorrect, please check';
                header('location: ../views/user.php');
                exit;
            } 
        } 


    }

    // var_dump($records_tobeupload);
    $user_details = [];
    $count = 0;
    foreach ($records_tobeupload as $file_records){
        $name = $file_records['name'];
        if (empty($user_details)){
            if ($file_records['last_grade_cat'] == 'H'){
                $data = array(
                    'name' => $file_records['name'],
                    'quarter_num' => $file_records['quarter_num'],
                    'year' => $file_records['year'],
                    'hw_grades' => [],
                    't_grades' => [],
                    'hw_sum' => 0,
                    'hw_ave' => 0,
                    't_sum' => 0,
                    't_ave' => 0,
                    'hw_count' => 0,
                    't_count' => 0,
                    'f_grade' => 0,
                );
            }

            if ($file_records['last_grade_cat'] == 'T'){
                $data = array(
                    'name' => $file_records['name'],
                    'quarter_num' => $file_records['quarter_num'],
                    'year' => $file_records['year'],
                    'hw_grades' => [],
                    't_grades' => [],
                    't_sum' => 0,
                    't_ave' => 0,
                    'hw_sum' => 0,
                    'hw_ave' => 0,
                    'hw_count' => 0,
                    't_count' => 0,
                    'f_grade' => 0,
                );
            }
            $user_details[$name] = $data;

            if(array_key_exists($name, $user_details)){
                $count++;
                
                // update hw grade if current loop is cat h
                // update t grade if current loop is cat t
                if ($file_records['last_grade_cat'] == 'H'){
                    $user_details[$name]['hw_count']++;
                    array_push($user_details[$name]['hw_grades'], $file_records['grade']);
                    $user_details[$name]['hw_sum'] += $file_records['grade'];
                    $user_details[$name]['hw_ave'] = $user_details[$name]['hw_sum']/$user_details[$name]['hw_count'];
                    $user_details[$name]['f_grade'] = ( 0.6 * $user_details[$name]['t_ave'] ) + ( 0.4 * $user_details[$name]['hw_ave'] ) ;
                }
    
                if ($file_records['last_grade_cat'] == 'T'){
                    $user_details[$name]['t_count']++;
                    array_push($user_details[$name]['t_grades'], $file_records['grade']);
                    $user_details[$name]['t_sum'] += $file_records['grade'];
                    $user_details[$name]['t_ave'] = $user_details[$name]['t_sum']/$user_details[$name]['t_count'];
                    $user_details[$name]['f_grade'] = ( 0.6 * $user_details[$name]['t_ave'] ) + ( 0.4 * $user_details[$name]['hw_ave'] ) ;
                }
            }
        } else {
            if(array_key_exists($name, $user_details)){
                // update hw grade if current loop is cat h
                // update t grade if current loop is cat t
                if ($file_records['last_grade_cat'] == 'H'){
                    $user_details[$name]['hw_count']++;
                    array_push($user_details[$name]['hw_grades'], $file_records['grade']);
                    $user_details[$name]['hw_sum'] += $file_records['grade'];
                    $user_details[$name]['hw_ave'] = $user_details[$name]['hw_sum']/$user_details[$name]['hw_count'];
                    $user_details[$name]['f_grade'] = ( 0.6 * $user_details[$name]['t_ave'] ) + ( 0.4 * $user_details[$name]['hw_ave'] ) ;
                }
    
                if ($file_records['last_grade_cat'] == 'T'){
                    $user_details[$name]['t_count']++;
                    array_push($user_details[$name]['t_grades'], $file_records['grade']);
                    $user_details[$name]['t_sum'] += $file_records['grade'];
                    $user_details[$name]['t_ave'] = $user_details[$name]['t_sum']/$user_details[$name]['t_count'];
                    $user_details[$name]['f_grade'] = ( 0.6 * $user_details[$name]['t_ave'] ) + ( 0.4 * $user_details[$name]['hw_ave'] ) ;
                }
            } else {
                // update hw grade if current loop is cat h
                // update t grade if current loop is cat t
                // array push
                if ($file_records['last_grade_cat'] == 'H'){
                    $data = array(
                        'name' => $file_records['name'],
                        'quarter_num' => $file_records['quarter_num'],
                        'year' => $file_records['year'],
                        'hw_grades' => [],
                        't_grades' => [],
                        'hw_sum' => 0,
                        'hw_ave' => 0,
                        't_sum' => 0,
                        't_ave' => 0,
                        'hw_count' => 0,
                        't_count' => 0,
                        'f_grade' => 0,
                    );
                }
    
                if ($file_records['last_grade_cat'] == 'T'){
                    $data = array(
                        'name' => $file_records['name'],
                        'quarter_num' => $file_records['quarter_num'],
                        'year' => $file_records['year'],
                        'hw_grades' => [],
                        't_grades' => [],
                        't_sum' => 0,
                        't_ave' => 0,
                        'hw_sum' => 0,
                        'hw_ave' => 0,
                        'hw_count' => 0,
                        't_count' => 0,
                        'f_grade' => 0,
                    );
                }
                $user_details[$name] = $data;
    
    
            }
        }
    }


    foreach ($user_details as $index => $details){
        $user_details[$index]['hw_sum'] = $details['hw_sum'] - min($details['hw_grades']);
        $user_details[$index]['hw_ave'] = ($user_details[$index]['hw_sum']) / ($user_details[$index]['hw_count'] - 1);
        $user_details[$index]['f_grade'] = ( 0.6*$details['t_ave'] ) + ( 0.4*$user_details[$index]['hw_ave'] );
    }
    // if users is in array
    // if not, array push details of users
    // details consist of final grade, ave 
    $_SESSION["success_compute"] = $user_details;
    header('location: ../views/user.php');


?>

