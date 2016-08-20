<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    require_once 'event.php';
    
    if(!isset($_POST['time'])){
        die('time not define!');
    }
    if(!isset($_POST['username'])){
        die('username not define!');
    }
    if(!isset($_POST['action'])){
        die('action not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    $action = $_POST['action'];
    if(empty($action)) {
        die('action is empty!');
    }
    
    runConnect();
    
    mysql_query("INSERT INTO sleepInfo(time, action) VALUES ('$time', '$action')");
    
    if(mysql_errno()){
        echo mysql_error();
    } else {
        
        $message = array();
        $message["time"] = $time;
        $message["type"] = "trip";
        $message["action"] = $action;
        
        pushEventToChild($time, $username, "sleep", "your parent has ".$action);
        
        pushRawNotificationToChild($username, $message);
    }
    
    
    
