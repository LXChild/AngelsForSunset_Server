<?php
require_once 'connectDB.php';
    
function queryChannelURL($username) {
    runConnect();
    $result = mysql_query("SELECT * FROM channel WHERE username = '$username'");
    if($result != null && $result != false) {
        $dataCount = mysql_num_rows($result);
        if ($dataCount > 0) {
            return $result;
        } else {
            return null;
        }
    } else {
        return null;
    }
}