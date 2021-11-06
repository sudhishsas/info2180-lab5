<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<ul>
<?php foreach ($results as $row): ?>
  <?php if($country === $row['name']){  ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
  
    <?php } ?>
<?php endforeach; ?>
</ul>

