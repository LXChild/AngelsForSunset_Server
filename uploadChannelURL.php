<?php
require_once 'connectDB.php';
if(!isset($_POST['username'])) {
    die('username not define!');
}
if(!isset($_POST['channelurl'])){
    die('channelurl not define!');
}

$username = $_POST['username'];
if(empty($username)) {
    die('username is empty!');
}

$channelurl = $_POST['channelurl'];
if(empty($channelurl)) {
    die('channelurl is empty!');
}

runConnect();
$result = mysql_query("SELECT * FROM channel WHERE username = '$username'");
if($result != null && $result != false) {
    $dataCount = mysql_num_rows($result);
    if ($dataCount > 0) {
        mysql_query("UPDATE channel SET channelurl = '$channelurl' WHERE username = '$username'");
    } else {
        mysql_query("INSERT INTO channel(username, channelurl) VALUES ('$username', '$channelurl')");
    }
    if(mysql_errno()){
        echo mysql_error();
    } else {
        echo "succeed";
    }
}


