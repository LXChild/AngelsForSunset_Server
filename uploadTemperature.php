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
    if(!isset($_POST['temperature'])){
        die('temperature not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    $temperature = $_POST['temperature'];
    if(empty($temperature)) {
        die('temperature is empty!');
    }
    $temperature = doubleval($temperature);
    
    runConnect();
    
    mysql_query("INSERT INTO temperature(time, temperature) VALUES ('$time', '$temperature')");
    
    if(mysql_errno()){
        echo mysql_error();
    } else {
        $temp = mt_rand(365, 372)/10;
        
        $message = array();
        $message["time"] = $time;
        $message["type"] = "temperature";
        //$message["temperature"] = $temperature;
        $message["temperature"] = $temp;
        
        if ($temperature > 37.5) {
            $message["temperature"] = $temperature;
            pushEventToChild($time, $username, "temperature", "temperature is higher than normal! Please pay more attention to him/her. Strongly recommend you to take him/her to do physical examination in order to prevent the potential severity disease.");
        }

        pushRawNotificationToChild($username, $message);
    }
    
