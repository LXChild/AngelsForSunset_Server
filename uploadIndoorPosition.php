<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    
    if(!isset($_POST['time'])){
        die('time not define!');
    }
    if(!isset($_POST['username'])){
        die('username not define!');
    }
    if(!isset($_POST['room'])){
        die('room not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    $room = $_POST['room'];
    if(empty($room)) {
        die('room is empty!');
    }
    
    runConnect();
    
    mysql_query("INSERT INTO indoorPosition(time, room) VALUES ('$time', '$room')");
    
    if(mysql_errno()){
        echo mysql_error();
    } else {
        
        $message = array();
        $message["time"] = $time;
        $message["type"] = "indoorPosition";
        $message["room"] = $room;
        
        pushRawNotificationToChild($username, $message);
    }
    
    
    
