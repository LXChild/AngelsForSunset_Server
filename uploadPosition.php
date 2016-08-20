<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    
    if(!isset($_POST['time'])){
        die('time not define!');
    }
    if(!isset($_POST['username'])){
        die('username not define!');
    }
    if(!isset($_POST['longitude'])){
        die('longitude not define!');
    }
    if(!isset($_POST['latitude'])){
        die('latitude not define!');
    }
    
    $time = $_POST['time'];
    if(empty($time)) {
        die('time is empty!');
    }
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    $longitude = $_POST['longitude'];
    if(empty($longitude)) {
        die('longitude is empty!');
    }
    $longitude = doubleval($longitude);
    
    $latitude = $_POST['latitude'];
    if(empty($latitude)) {
        die('latitude is empty!');
    }
    $latitude = doubleval($latitude);
    
    runConnect();
    
    mysql_query("INSERT INTO outdoorPosition(time, longitude, latitude) VALUES ('$time', '$longitude', '$latitude')");
    
    if(mysql_errno()){
        echo mysql_error();
    } else {
        
        $message = array();
        $message["time"] = $time;
        $message["type"] = "position";
        $message["longitude"] = $longitude;
        $message["latitude"] = $latitude;
        
        pushRawNotificationToChild($username, $message);
    }
    
    
    
