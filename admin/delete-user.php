<?php
include 'db.php';

if (isset($_GET['id'])) {
  $userID = $_GET['id'];

  $conn->query("DELETE FROM user_role WHERE user_id = $userID");
  $conn->query("DELETE FROM user WHERE id = $userID");

  header("Location: manage-user.php");
  exit();
}
