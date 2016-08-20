<?php
    require_once 'connectDB.php';
    
    function queryParentUsername($username) {
        
        runConnect();
        $result = mysql_query("SELECT * FROM relations WHERE childname = '$username'");
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
