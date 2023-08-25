<?php 
session_start();
include("config.php");
if(isset($_POST['save_reg']))
{
    $email = $_SESSION['login_user'];
    $update_values = array();

    if(isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = mysqli_real_escape_string($db, $_POST['dob']);
        $update_values[] = "dob='$dob'";
    }

    if(isset($_POST['address']) && !empty($_POST['address'])) {
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $update_values[] = "address='$address'";
    }

    if(isset($_POST['age']) && !empty($_POST['age'])) {
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $update_values[] = "age='$age'";
    }

    if(isset($_POST['hobbies']) && !empty($_POST['hobbies'])) {
        $hobbies = mysqli_real_escape_string($db, $_POST['hobbies']);
        $update_values[] = "hobbies='$hobbies'";
    }

    if(isset($_POST['job']) && !empty($_POST['job'])) {
        $job = mysqli_real_escape_string($db, $_POST['job']);
        $update_values[] = "job='$job'";
    }

    if(isset($_POST['skill']) && !empty($_POST['skill'])) {
        $skill = mysqli_real_escape_string($db, $_POST['skill']);
        $update_values[] = "skill='$skill'";
    }

    if(!empty($update_values)) {
        $update_query = implode(', ', $update_values);
        $query = "UPDATE user1 SET $update_query WHERE mail='$email'";
        $query_run = mysqli_query($db, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
                
            ];
            
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Details Not Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
    else {
        $res = [
            'status' => 400,
            'message' => 'No valid input provided for updating'
        ];
        echo json_encode($res);
        return;
    }
	
}  
?>

