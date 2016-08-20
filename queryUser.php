<?php
require_once 'connectDB.php';

if(!isset($_POST['username'])) {
    die('username not define!');
}
if(!isset($_POST['password'])){
    die('password not define!');
}

$username = $_POST['username'];
$password = $_POST['password'];

runConnect();
$result = mysql_query("SELECT * FROM account Where username = '$username' and password = '$password'");
if($result != null && $result != false) {
    $dataCount = mysql_num_rows($result);
    if ($dataCount > 0) {
        echo "succeed";
    } else {
        echo "Sign in Failed, Please check the Username or Password!";
    }
} else {
    echo "failed";
}
