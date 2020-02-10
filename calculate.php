<?php
$conn = new mysqli('localhost', 'root', '', 'inventory') 
or die ('Cannot connect to db');

$id = $_GET['Product_ID'];

$sql = "SELECT Product_ID , ( Unit_Buy / Unit_Sell ) * 100 AS `Total` FROM product WHERE Product_ID ='$id'";

$result = mysqli_query($conn, $sql);

$margin=0;
while($row = mysqli_fetch_array($result)) {
    $margin += $row['Total'];
}
?>
<!--echo 'The increasing margin in percentage(%) is: ' . $margin;-->
<SCRIPT LANGUAGE='JavaScript'>         
window.alert('The increasing margin in percentage(%) is: <?php echo $margin; ?>')         
window.location.href='calculateMargin.php'         
</SCRIPT>