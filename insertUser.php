<?php
require_once 'connectDB.php';

if(!isset($_POST['username'])){
    die('username not define!');
}
if(!isset($_POST['password'])){
    die('password not define!');
}

$username = $_POST['username'];
if(empty($username)) {
    die('username is empty!');
}

$password = $_POST['password'];
if(empty($password)) {
    die('password is empty!');
}

runConnect();

mysql_query("INSERT INTO account(username, password) VALUES ('$username', '$password')");

if(mysql_errno()){
    echo mysql_error();
} else {
    echo "succeed";
}


