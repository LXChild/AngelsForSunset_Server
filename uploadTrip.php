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
    if(!isset($_POST['place'])){
        die('place not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    $place = $_POST['place'];
    if(empty($place)) {
        die('place is empty!');
    }
    
    runConnect();
    
    mysql_query("INSERT INTO trip(time, place) VALUES ('$time', '$place')");
    
    if(mysql_errno()){
        echo mysql_error();
    } else {
        
        $message = array();
        $message["time"] = $time;
        $message["type"] = "trip";
        $message["place"] = $place;
        
        pushEventToChild($time, $username, "trip", "your parent has triped in ".$place);
        
        pushRawNotificationToChild($username, $message);
    }
    
    
    
