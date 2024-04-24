<?php
include 'components/connect.php';
$query = $_GET['query'];
$sql = "SELECT name FROM cities WHERE name LIKE :query LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':query', '%' . $query . '%');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($results);
?>



