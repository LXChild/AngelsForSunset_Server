<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    
    if(!isset($_POST['date'])){
        die('date not define!');
    }
    
    if(!isset($_POST['username'])){
        die('username not define!');
    }
    
    if(!isset($_POST['dining'])){
        die('dining not define!');
    }
    if(!isset($_POST['detail_dining'])){
        die('detail_dining not define!');
    }
    
    if(!isset($_POST['sleep'])){
        die('sleep not define!');
    }
    if(!isset($_POST['detail_sleep'])){
        die('detail_sleep not define!');
    }
    
    if(!isset($_POST['toilet'])){
        die('toilet not define!');
    }
    if(!isset($_POST['detail_toilet'])){
        die('detail_toilet not define!');
    }
    
    if(!isset($_POST['parlour'])){
        die('parlour not define!');
    }
    if(!isset($_POST['detail_parlour'])){
        die('detail_parlour not define!');
    }
    
    if(!isset($_POST['outdoor'])){
        die('outdoor not define!');
    }
    if(!isset($_POST['detail_outdoor'])){
        die('detail_outdoor not define!');
    }
    
    $date = $_POST['date'];
    if(empty($date)) {
        die('date is empty!');
    }
    
    $username = $_POST['username'];
    if(empty($username)) {
        die('username is empty!');
    }
    
    $dining = $_POST['dining'];
    if(empty($dining)) {
        die('dining is empty!');
    }
    $dining = doubleval($dining);
    $detail_dining = $_POST['detail_dining'];
    if(empty($detail_dining)) {
        die('detail_dining is empty!');
    }
    
    $sleep = $_POST['sleep'];
    if(empty($sleep)) {
        die('sleep is empty!');
    }
    $sleep = doubleval($sleep);
    $detail_sleep = $_POST['detail_sleep'];
    if(empty($detail_sleep)) {
        die('detail_sleep is empty!');
    }
    
    $toilet = $_POST['toilet'];
    if(empty($toilet)) {
        die('toilet is empty!');
    }
    $toilet = doubleval($toilet);
    $detail_toilet = $_POST['detail_toilet'];
    if(empty($detail_toilet)) {
        die('detail_toilet is empty!');
    }
    
    $parlour = $_POST['parlour'];
    if(empty($parlour)) {
        die('parlour is empty!');
    }
    $parlour = doubleval($parlour);
    $detail_parlour = $_POST['detail_parlour'];
    if(empty($detail_parlour)) {
        die('detail_parlour is empty!');
    }
    
    $outdoor = $_POST['outdoor'];
    if(empty($outdoor)) {
        die('outdoor is empty!');
    }
    $outdoor = doubleval($outdoor);
    $detail_outdoor = $_POST['detail_outdoor'];
    if(empty($detail_outdoor)) {
        die('detail_outdoor is empty!');
    }
    
    runConnect();
    $result = mysql_query("SELECT * FROM daily WHERE date = '$date'");
    if($result != null && $result != false) {
        $dataCount = mysql_num_rows($result);
        if ($dataCount > 0) {
            mysql_query("UPDATE daily SET dining = '$dining', detail_dining = '$detail_dining', sleep = '$sleep', detail_sleep = '$detail_sleep', toilet = '$toilet', detail_toilet = '$detail_toilet', parlour = '$parlour', detail_parlour = '$detail_parlour', outdoor = '$outdoor', detail_outdoor = '$detail_outdoor'  WHERE date = '$date'");
        } else {
            mysql_query("INSERT INTO daily(date, dining, detail_dining, sleep, detail_sleep, toilet, detail_toilet, parlour, detail_parlour, outdoor, detail_outdoor) VALUES ('$date', '$dining', '$detail_dining', '$sleep', '$detail_sleep', '$toilet', '$detail_toilet', '$parlour', '$detail_parlour', '$outdoor', '$detail_outdoor')");
        }
        if(mysql_errno()){
            echo mysql_error();
        } else {
            
            $message = array();
            $message["date"] = $date;
            $message["type"] = "daily";
            $message["dining"] = $dining;
            $message["detail_dining"] = $detail_dining;
            $message["sleep"] = $sleep;
            $message["detail_sleep"] = $detail_sleep;
            $message["toilet"] = $toilet;
            $message["detail_toilet"] = $detail_toilet;
            $message["parlour"] = $parlour;
            $message["detail_parlour"] = $detail_parlour;
            $message["outdoor"] = $outdoor;
            $message["detail_outdoor"] = $detail_outdoor;
            
            pushRawNotificationToChild($username, $message);
        }
    }
    

    
    
    
