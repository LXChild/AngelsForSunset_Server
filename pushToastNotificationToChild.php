<?php
    require_once 'queryChildUsername.php';
    require_once 'pushToastNotificationHelper.php';
    
    function pushToastNotificationToChild($username, $message) {
        
        $childUsername = null;
        while($childUsername == null) {
            $result = queryChildUsername($username);
            if($result != null && $result != false) {
                $dataCount = mysql_num_rows($result);
                if($dataCount > 0){
                    for($i = 0; $i < $dataCount; $i++) {
                        $result_arr = mysql_fetch_assoc($result);
                        $childUsername = $result_arr['childname'];
                        pushToastNotificationHelper($childUsername, $message);
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