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
if(!isset($_POST['beat'])){
    die('beat not define!');
}

$time = $_POST['time'];
if(empty($time)) {
    die('time is empty!');
}
$username = $_POST['username'];
if(empty($username)) {
    die('username is empty!');
}
$beat = $_POST['beat'];
if(empty($beat)) {
    die('beat is empty!');
}
$beat = intval($beat);

runConnect();

mysql_query("INSERT INTO heartbeat(time, beat) VALUES ('$time', '$beat')");

if(mysql_errno()){
    echo mysql_error();
} else {
    $rate = mt_rand(68, 78);
    
    $message = array();
    $message["time"] = $time;
    $message["type"] = "heartbeat";
    //$message["beat"] = $beat;
    $message["beat"] = $rate;
    
//    if ($beat > 100) {
//        $message["beat"] = $beat;
//        pushEventToChild($time, $username, "heartbeat", "heartbeat is faster than normal! Please remind him/her to relax and keep a regular lifestyle");
//    }
    pushRawNotificationToChild($username, $message);
}



