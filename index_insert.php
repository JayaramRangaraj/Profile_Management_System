<?php 
session_start();
include("config.php");

if (isset($_POST['save_a-form'])) {
    $name = mysqli_real_escape_string($db, $_POST['uname']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    
    if ($name == NULL) {
        $res = [
            'status' => 500,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Check if email already exists
    $check_query = "SELECT * FROM user1 WHERE mail = '$mail'";
    $check_result = mysqli_query($db, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $res = [
            'status' => 500,
            'message' => 'Email already exists'
        ];
        echo json_encode($res);
        return;
    }

    // Insert the new user details
    $insert_query = "INSERT INTO user1 (uname, mail, pass) VALUES ('$name', '$mail', '$pass')";
    $query_run = mysqli_query($db, $insert_query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}  
?>

