<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationToChild.php';
    require_once 'pushToastNotificationToChild.php';
    
    function pushEventToChild($time, $username, $title, $content) {
        
        runConnect();
        
        mysql_query("INSERT INTO event(time, title, content) VALUES ('$time', '$title', '$content')");
        
        if(mysql_errno()){
            echo mysql_error();
        } else {
            
            $message = array();
            $message["time"] = $time;
            $message["type"] = "event";
            $message["title"] = $title;
            $message["content"] = $content;
            
            pushToastNotificationToChild($username, $content);
            pushRawNotificationToChild($username, $message);
        }
    }
    

    
    
    
