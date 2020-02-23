<?php 
    require_once('connect.php');
    include('../model/Classes/ConnectDb.php');

    $quarter_num = $_POST['quarter_num'];
    $qaurter_records_users = [];

    
    $u_records = mysqli_query($conn, "SELECT * FROM users ORDER BY full_name ASC ");
    
    foreach ($u_records as $user){
        $homework_records_users = '';
        $homework_records_users_array = [];
        $test_records_users = '';
        $homework_sum = 0;
        $homework_count = 0;
        $test_sum = 0;
        $test_count = 0;

        $qr_records = mysqli_query($conn, "SELECT * FROM quarter_records WHERE user_id = {$user['id']} AND quarter = '$quarter_num'");
        
        if( ! empty(mysqli_fetch_assoc($qr_records)) ){
            foreach($qr_records as $qr){
                $g_records = mysqli_query($conn, "SELECT * FROM grade_records WHERE qr_id ={$qr['id']}");
                foreach($g_records as $gr){
                    if($gr['grade_category']=='H'){
                        $homework_records_users = $homework_records_users . ' ' . $gr['grade'];
                        array_push($homework_records_users_array, $gr['grade']);
                        $homework_sum += $gr['grade'];
                        $homework_count++;
                    } else {
                        $test_records_users = $test_records_users . ' ' . $gr['grade'];
                        $test_sum += $gr['grade'];
                        $test_count++;
                    }
                }
                // get lowest grade. 
                $hw_lowest_grade = min($homework_records_users_array);
                $final_ave = ( 0.6 * ($test_sum/$test_count) ) + ( 0.4 * (($homework_sum - $hw_lowest_grade)/($homework_count-1)) );
                $data = [
                    'name'                            => $user['full_name'],
                    'quarter'                         => $quarter_num,
                    'year'                            => $qr['year'],
                    'homework_ave'                    => number_format(($homework_sum/$homework_count), 2),
                    'test_ave'                        => number_format(($test_sum/$test_count), 2),
                    'homework_records_users'          => $homework_records_users,
                    'test_records_users'              => $test_records_users,
                    'final_ave'                       => number_format($final_ave, 2),
                    'hw_lowest_grade'                 => $hw_lowest_grade,
                ];
                array_push($qaurter_records_users, $data);
            }
        }
       
    }      

    echo json_encode($qaurter_records_users);
?>