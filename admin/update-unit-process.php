<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];


  $stmt = $conn->prepare("UPDATE unit SET name = ?, description = ? WHERE id = ?");
  $stmt->bind_param("ssi", $name, $description, $id);
  $stmt->execute();

  header("Location: manage-unit.php");
  exit();
}
