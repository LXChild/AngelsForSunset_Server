<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    require_once 'pushRawNotificationToParent.php';
    require_once 'pushToastNotificationToChild.php';
    require_once 'pushToastNotificationToParent.php';
    
    if(!isset($_POST['time'])){
        die('time not define!');
    }
    if(!isset($_POST['username'])){
        die('username not define!');
    }
    if(!isset($_POST['role'])){
        die('role not define!');
    }
    if(!isset($_POST['message'])){
        die('message not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    
    $role = $_POST['role'];
    if(empty($role)) {
        die('role is empty!');
    }
    
    $message = $_POST['message'];
    if(empty($message)) {
        die('message is empty!');
    }
    
//    runConnect();
//    
//    mysql_query("INSERT INTO account(username, password) VALUES ('$username', '$password')");
//    
//    if(mysql_errno()){
//        echo mysql_error();
//    } else {
//        echo "succeed";
//    }
    $rawMessage = array();
    $rawMessage["time"] = $time;
    $rawMessage["type"] = "remind";
    $rawMessage["message"] = $message;
    
    if($role == "parent") {
        pushToastNotificationToChild($username, $message);
        pushRawNotificationToChild($username, $rawMessage);
    } else if($role == "child") {
        pushToastNotificationToParent($username, $message);
        pushRawNotificationToParent($username, $rawMessage);        
    } else {
        echo "Wrong role!";
    }

    
    
