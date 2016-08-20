<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationHelper.php';

    
    if(!isset($_POST['username'])) {
        die('username not define!');
    }
    $username = $_POST['username'];
    
    if(!isset($_POST['parentname'])) {
        die('parentname not define!');
    }
    $parentname = $_POST['parentname'];
    
    runConnect();
    
    $message = array();
    $message["type"] = "requestBindRelation";
    $message["username"] = $username;
    
    pushRawNotificationHelper($parentname, $message);
   
