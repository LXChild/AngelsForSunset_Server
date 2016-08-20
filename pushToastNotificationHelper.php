<?php
    require_once 'connectDB.php';
    require_once 'notification.php';
    require_once 'queryChannelURL.php';
    
    function pushToastNotificationHelper($username, $message) {
        
        $accessToken = null;
        $channelURL = null;
        while($accessToken == null) {
            $jsonString = getAccessTokenJson();
            $arr = json_decode($jsonString, true);
            $tokenType = $arr['token_type'];
            $accessToken = $arr['access_token'];
        }
        while($channelURL == null) {
            $result = queryChannelURL($username);
            if($result != null && $result != false) {
                $dataCount = mysql_num_rows($result);
                if($dataCount > 0) {
                    for($i = 0; $i < $dataCount; $i++) {
                        $result_arr = mysql_fetch_assoc($result);
                        $channelURL = $result_arr['channelurl'];

                        pushToastNotification($message, $accessToken, $channelURL);
                    }
                } else {
                    echo "The username cound not be found,Please check again!";
                    break;
                }
            } else {
                echo "The username cound not be found,Please check again!";
                break;
            }
        }
    }
    
    
