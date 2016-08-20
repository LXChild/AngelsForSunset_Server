<?php
    require_once 'queryParentUsername.php';
    require_once 'pushRawNotificationHelper.php';
    
    function pushRawNotificationToParent($username, $message) {
        
        $parentUsername = null;
        while($parentUsername == null) {
            $result = queryParentUsername($username);
            if($result != null && $result != false) {
                $dataCount = mysql_num_rows($result);
                if($dataCount > 0){
                    for($i = 0; $i < $dataCount; $i++) {
                        $result_arr = mysql_fetch_assoc($result);
                        $parentUsername = $result_arr['parentname'];
                        pushRawNotificationHelper($parentUsername, $message);
                    }
                } else {
                    echo "Cound not found the child!";
                    break;
                }
            } else {
                echo "Cound not found the child!";
                break;
            }
        }
    }