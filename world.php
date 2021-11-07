<?php header('Access-Control-Allow-Origin: *'); ?>
<?php error_reporting(0); ?>

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'];
$lookup = $_GET['context'];
$check = 0;
$city = "";


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// checks for which button was clicked.
if(isset($lookup)){
    $check= 1;
}else{
  $check=2;
}

?>
 <?php // checks if the look up button was clicked and if the feild was empty to show the result relating to the given information ?>
<?php if($country !== "" && $check === 2){ 
  $country = trim(filter_var($country, FILTER_SANITIZE_STRING));?>
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

<?php //checks if the look up feild was empty and printing the default. ?>
<?php if($country === "" && $check === 2){?>
  <table>
      <tr>
        <th><?= 'Name'; ?></th>
        <th><?= 'Continent'; ?></th>
        <th><?= 'Independence'; ?></th>
        <th><?= 'Head of State'; ?></th>
      </tr>
  <?php $c = 0;foreach ($results as $row): ?>
    <?php $c =$c+1; if($country === "" ){ ?>
          <tr>
          <td><?= $row['name'];?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td> 
        </tr>
        <?php //shows an error message if the country wasnt valid ?>
    <?php }elseif($c == 239 && $country !== $row['name'] ){
    $check = 1;
    echo('<span style="color:red;">NOT A COUNTRY</span>');
    break;
  } ?> 
  <?php endforeach; ?>
</table>
  <?php } ?>


  <?php //checks for a countries code ?>
  <?php if($country !== "" && $check === 1 ){ 
  $country = trim(filter_var($country, FILTER_SANITIZE_STRING));?>
<?php $c = 0;foreach ($results as $row): ?>
    
  <?php $c =$c+1;if($country === $row['name']){  
        $city = $row['code'];
        break;
     } ?> 
<?php endforeach; ?>
<?php }?>

<?php //uses the code of a country to find the information form the list ?>
<?php if($city !== "" && $check === 1){ 
    // changing which list to read from in mySQL
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM cities");
  
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); ?> 
        <?php $c = 0;foreach ($results as $row): ?>
      <?php $c =$c+1;if($city === $row['country_code']){   ?>
        <table>
      <tr>
        <th><?= 'Name'; ?></th>
        <th><?= 'District'; ?></th>
        <th><?= 'Population'; ?></th>
      </tr>
        <tr>
          <td><?= $row['name'];?></td>
          <td><?= $row['district']; ?></td>
          <td><?= $row['population']; ?></td>
        </tr>
        </table>
        <?php break; ?>
        <?php }elseif($c == 4079 && $city !== $row['country_code'] ){
            
            echo('<span style="color:red;">NOT A COUNTRY</span>');
            break;
        } ?> 
    <?php endforeach; ?>
<?php } ?>



<?php if($city === "" && $check === 1){
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM cities");
  
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
  <table>
      <tr>
        <th><?= 'Name'; ?></th>
        <th><?= 'District'; ?></th>
        <th><?= 'Population'; ?></th>
      </tr>
  <?php $c = 0;foreach ($results as $row): ?>
    <?php $c =$c+1; if($city === "" ){ ?>
          <tr>
              <td><?= $row['name'];?></td>
              <td><?= $row['district']; ?></td>
              <td><?= $row['population']; ?></td>
          </tr>
    <?php }elseif($c == 4079 && $city !== $row['country_code'] ){
    $check = 1;
    echo('<span style="color:red;">NOT A COUNTRY</span>');
    break;
  } ?> 
  <?php endforeach; ?>
</table>
  <?php } ?>