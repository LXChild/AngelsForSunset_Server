<?php
    require_once 'connectDB.php';
    require_once 'pushRawNotificationHelper.php';
    
    if(!isset($_POST['parentname'])){
        die('parentname not define!');
    }
    if(!isset($_POST['childname'])){
        die('childname not define!');
    }
    if(!isset($_POST['answer'])){
        die('answer not define!');
    }
    
    $parentname = $_POST['parentname'];
    if(empty($parentname)) {
        die('parentname is empty!');
    }
    
    $childname = $_POST['childname'];
    if(empty($childname)) {
        die('childname is empty!');
    }
    
    $answer = $_POST['answer'];
    if(empty($answer)) {
        die('answer is empty!');
    }
    
    if($answer == "no"){
        $message = array();
        $message["type"] = "bindRelation";
        $message["result"] = "Bind Relation refused!";
        
        pushRawNotificationHelper($childname, $message);
    } else {
        runConnect();
        
        mysql_query("INSERT INTO relations(parentname, childname) VALUES ('$parentname', '$childname')");
        
        if(mysql_errno()){
            echo mysql_error();
        } else {
            $message = array();
            $message["type"] = "bindRelation";
            $message["result"] = "Bind Relation succeed!";
            
            pushRawNotificationHelper($parentname, $message);
            pushRawNotificationHelper($childname, $message);
        }
    }
 
    

    
    
