<?php
session_start();

require_once 'functions.php';
include_once 'dbconnect.php';

$dbh = db_connect();

$query = 'SELECT * FROM users WHERE user_id="'.$_SESSION['user'].'"';
$result = $mysqli->query($query);
// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $email = $row['email']; //ユーザーidの取り出し
}

$compsql = 'SELECT id, tasks.* FROM tasks WHERE done = 1 and delete_flg = 0 and email = "'.$email.'" ORDER BY id DESC limit 20 offset 0';
$stmt = $dbh->prepare($compsql);
$stmt->execute();
$comptask = $stmt->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);
$arraytask = array_values($comptask);

$getvalue = $arraytask;
$arraytask = ["get"=>$getvalue];
echo json_encode($arraytask, JSON_PRETTY_PRINT);