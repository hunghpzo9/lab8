<?php
require_once "./connect.php";
session_start();
//bắt đầU session
//nếu giá trị session user null thì về trang login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$deleteItemId = $_POST['deleteItemId'];
$sql = "update product set status = 0 where id = $deleteItemId";

$result = mysqli_query($conn, $sql);

?>