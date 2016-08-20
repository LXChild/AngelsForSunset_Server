<?php
function getAccessTokenJson() {
    $url_accessToken = "https://login.live.com/accesstoken.srf";
    $sid = "ms-app://s-1-15-2-3675636326-4016741227-4035217167-3301643020-1429564504-2017184503-2955188398";
    $secret = "Dyrojayxu5AVAi9cx1TcyxTKSZztR2p5";
    //$content = fixEncoding("grant_type=client_credentials&client_id='$sid'&client_secret='$secret'&scope=notify.windows.com");

    $content = array('grant_type'=>'client_credentials',
              'client_id'=>$sid,
              'client_secret'=>$secret,
              'scope'=>'notify.windows.com');    
    $postcontent = http_build_query($content);
    $options = array(  
                        'http' => array(
                                            'method' => 'POST',
                                            'header' => 'Content-type:application/x-www-form-urlencoded',
                                            'content' => $postcontent,
                                            'timeout' => 15 * 60 // 超时时间（单位:s）
                                        )
                     );
  $context = stream_context_create($options);
  $result = file_get_contents($url_accessToken, false, $context);
  return $result; 
}
    
function pushToastNotification($message, $token, $channelURL)
{
    $toastMessage = "
        <toast>
            <visual>
                <binding template="."\"ToastText02\"".">
                    <text id = "."\"1\"".">".$message."</text>
                </binding>
            </visual>
        </toast>";
    $toastMessage = fixEncoding($toastMessage);

    $options = array(
                     'http' => array(
                                     'method' => 'POST',
                                     'header' => "Content-type:text/xml\r\n".
                                                 "Authorization:bearer ".$token."\r\n".
                                                 "X-WNS-Type:wns/toast",
                                     'content' => $toastMessage,
                                     'timeout' => 15 * 60 // 超时时间（单位:s）
                                     )  
                     );  
    $context = stream_context_create($options);
    $result = file_get_contents($channelURL, false, $context);
    echo $result;
}
    
function pushRawNotification($message, $token, $channelURL)
{
    $message = fixEncoding($message);
        
    $options = array(
                     'http' => array(
                                     'method' => 'POST',
                                     'header' => "Content-type:application/octet-stream\r\n".
                                     "Authorization:bearer ".$token."\r\n".
                                     "X-WNS-Type:wns/raw",
                                     'content' => $message,
                                     'timeout' => 15 * 60 // 超时时间（单位:s）
                                     )
                    );
    $context = stream_context_create($options);
    $result = file_get_contents($channelURL, false, $context);
    echo $result;
}
    
function fixEncoding($in_str)
{
    $cur_encoding = mb_detect_encoding($in_str) ;
        
    if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8")) {
        return $in_str;
    }
    else {
        return utf8_encode($in_str);
    }
}
