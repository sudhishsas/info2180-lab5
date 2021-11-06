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

<?php if($country !== ""){ ?>
<?php $c = 0;foreach ($results as $row): ?>
  <?php $c =$c+1;if($country === $row['name']){   ?>
    <table>
  <tr>
    <th><?= 'Name'; ?></th>
    <th><?= 'Continent'; ?></th>
    <th><?= 'Independence'; ?></th>
    <th><?= 'Head of State'; ?></th>
  </tr>
    <tr>
      <td><?= $row['name'];?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
    </table>
    <?php break; ?>
    <?php }elseif($c == 239 && $country !== $row['name'] ){
        
        echo('<span style="color:red;">NOT A COUNTRY</span>');
        break;
     } ?> 
<?php endforeach; ?>
<?php } ?>

<?php if($country === ""){?>
  <table>
      <tr>
        <th><?= 'Name'; ?></th>
        <th><?= 'Continent'; ?></th>
        <th><?= 'Independence'; ?></th>
        <th><?= 'Head of State'; ?></th>
      </tr>
  <?php $c = 0;foreach ($results as $row): ?>
    <?php if($country === "" ){ ?>
          <tr>
          <td><?= $row['name'];?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td> 
        </tr>
    <?php }elseif($c == 239 && $country !== $row['name'] ){
    $check = 1;
    echo('<span style="color:red;">NOT A COUNTRY</span>');
    break;
  } ?> 
  <?php endforeach; ?>
</table>
  <?php } ?>
  