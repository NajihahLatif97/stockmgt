<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<html lang = "en">

<head>

     <meta charset = "utf - 8">
	 <meta name = "viewport" content = "width = device-width, initial-scale = 1">
	 <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script>
    function Confirm()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
	</script> 
	
</head>
	 
<title>

FR Inventory System
    
</title>

<style>

table, th, td {
    border: 0px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}

header{border : 2px solid black;
       background-color : #3399FF;
	   padding-top : 15px;
	   padding-bottom : 15px;
       color : black;
	   text-align : center;
	   font-size : 200%}
	   
footer{border : 2px solid black;
       background-color : #3399FF;
	   text-align : center;
	   padding-top : 10px;
	   padding-bottom : 10px;
       color : black;}
	   
nav{border : 2px solid black;
    background-color : white;
	color : black;
	text-align :top left;
	max-width : 1140px;}
	   
body{background-image : url("imageFR.jpg");
     background-position : top center;
	 background-attachment : fixed;}
	 

		
image{text-align : center;}
	   
</style>

</head>

<body>

<div class = "container">

<header>

FR RETAIL SHOP INVENTORY SYSTEM

     <p>
	 
     <button type="button" class="btn btn-home"><a href = "mainPage.html">Home</a></button>
     <button type="button" class="btn btn-system"><a href = "systemPage.html">System</a></button>
	 <button type="button" class="btn btn-logout"><a href = "htmlloginFirst.html" onclick='return confirm();'>Logout</a></button>

	 
	 </p>
	 
</header>

<br>
<nav id="system" class="container-fluid">
<body>
<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("connect-db.php");

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($type = '', $typeid ='', $supplierid ='', $productname ='', $quantity ='', $location ='', $unitbuy ='', $unitsell ='', $error = '', $id = '')
{ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Product"; } else { echo "New Product"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Product"; } else { echo "New Product"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<?php
$conn = new mysqli('localhost', 'root', '', 'inventory') 
or die ('Cannot connect to db');

$result = $conn->query("select Supplier_ID from supplier");
?>
<br>
<form action="" method="post">
<div>

<?php if ($id != '') { ?>
<input type="hidden" name="Product_ID" value="<?php echo $id; ?>" />
<p>Product ID: <?php echo $id; ?></p>
<?php } ?>

<table style="width:50%">
<tr>
<td><strong>Type: *</strong></td><td> <input type="text" placeholder="Clothes/Gift/etc" name="Type"
value="<?php echo $type; ?>"/></td></tr>
<tr><td><strong>Type ID: *</strong></td><td> <input type="text" placeholder="9999" name="Type_ID"
value="<?php echo $typeid; ?>"/></td></tr>
<tr><td><strong>Supplier ID: </strong></td><td> <select name='Supplier_ID' onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;">";
<?php
    while ($row = $result->fetch_assoc()) {

                  unset($Supplier_ID);
                  $Supplier_ID = $row['Supplier_ID'];
                  echo '<option value="'.$Supplier_ID.'">'.$Supplier_ID.'</option>';
                 
}

    echo "</select>";?></td></tr>
<tr><td><strong>Product Name: </strong></td><td> <input type="text" placeholder="Product name" name="Product_Name"
value="<?php echo $productname; ?>"/></td></tr>
<tr><td><strong>Quantity: </strong></td><td> <input type="text" placeholder="Current amount" name="Quantity"
value="<?php echo $quantity; ?>"/></td></tr>
<tr><td><strong>Location: </strong></td><td> <input type="text" placeholder="999" name="Location"
value="<?php echo $location; ?>"/></td></tr>
<tr><td><strong>Unit Buy: </strong></td><td> <input type="text" placeholder="999.99" name="Unit_Buy"
value="<?php echo $unitbuy; ?>"/></td></tr>
<tr><td><strong>Unit Sell: </strong></td><td> <input type="text" placeholder="999.99" name="Unit_Sell"
value="<?php echo $unitsell; ?>"/></td></tr>
</table>
<p>* required</p>
<input type="submit" name="submit" value="Submit" /><p></p>
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['Product_ID']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['Product_ID']))
{
// get variables from the URL/form
$id = $_POST['Product_ID'];
$Type = htmlentities($_POST['Type'], ENT_QUOTES);
$Type_ID = htmlentities($_POST['Type_ID'], ENT_QUOTES);
$Supplier_ID = htmlentities($_POST['Supplier_ID'], ENT_QUOTES);
$Product_Name = htmlentities($_POST['Product_Name'], ENT_QUOTES);
$Quantity = htmlentities($_POST['Quantity'], ENT_QUOTES);
$Location = htmlentities($_POST['Location'], ENT_QUOTES);
$Unit_Buy = htmlentities($_POST['Unit_Buy'], ENT_QUOTES);
$Unit_Sell = htmlentities($_POST['Unit_Sell'], ENT_QUOTES);

// check that data required not empty
if ($Type == '' || $Type_ID == '' || $Supplier_ID == '' || $Product_Name == '' || $Quantity == '' || $Location == '' || $Unit_Buy == '' || $Unit_Sell == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE product SET Type = '$Type', Type_ID = '$Type_ID', Supplier_ID = '$Supplier_ID', Product_Name = '$Product_Name', Quantity = '$Quantity', Location = '$Location', Unit_Buy = '$Unit_Buy', Unit_Sell = '$Unit_Sell'
WHERE Product_ID='$id'"))
{
$stmt->bind_param("ssi", $Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: viewPage.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['Product_ID']) && $_GET['Product_ID'] > 0)
{
// get 'id' from URL
$id = $_GET['Product_ID'];

// get the recod from the database
if($stmt = $mysqli->prepare("SELECT * FROM product WHERE Product_ID='$id'"))
{
$stmt->execute();

$stmt->bind_result($id, $Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell);
$stmt->fetch();

// show the form
renderForm($Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the viewPage.php page
else
{
header("Location: viewPage.php");
}
}
}



/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$Type = htmlentities($_POST['Type'], ENT_QUOTES);
$Type_ID = htmlentities($_POST['Type_ID'], ENT_QUOTES);
$Supplier_ID = htmlentities($_POST['Supplier_ID'], ENT_QUOTES);
$Product_Name = htmlentities($_POST['Product_Name'], ENT_QUOTES);
$Quantity = htmlentities($_POST['Quantity'], ENT_QUOTES);
$Location = htmlentities($_POST['Location'], ENT_QUOTES);
$Unit_Buy = htmlentities($_POST['Unit_Buy'], ENT_QUOTES);
$Unit_Sell = htmlentities($_POST['Unit_Sell'], ENT_QUOTES);

// check that data required not empty
if ($Type == '' || $Type_ID == '' || $Supplier_ID == '' || $Product_Name == '' || $Quantity == '' || $Location == '' || $Unit_Buy == '' || $Unit_Sell == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell, $error);
}
else
{
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT product (Type, Type_ID, Supplier_ID, Product_Name, Quantity, Location, Unit_Buy, Unit_Sell) VALUES ('$Type', '$Type_ID', '$Supplier_ID', '$Product_Name', '$Quantity', '$Location', '$Unit_Buy', '$Unit_Sell')"))
{
$stmt->bind_param("ss", $Type, $Type_ID, $Supplier_ID, $Product_Name, $Quantity, $Location, $Unit_Buy, $Unit_Sell);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: viewPage.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

// close the mysqli connection
$mysqli->close();
?>
</body>
</nav>

<br>

<footer>

FR RETAIL SHOP INVENTORY SYSTEM

</footer>

</nav>
</html>