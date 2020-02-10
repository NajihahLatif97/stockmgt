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
function renderForm($suppliername = '', $email ='', $address ='', $addresscode ='', $addresscity ='', $personincharge ='', $companyphoneno ='', $error = '', $id = '')
{ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Supplier"; } else { echo "New Supplier"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Supplier"; } else { echo "New Supplier"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>
<br>
<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="Supplier_ID" value="<?php echo $id; ?>" />
<p>Supplier ID: <?php echo $id; ?></p>
<?php } ?>

<table style="width:50%">
<tr>
<td><strong>Supplier Name: *</strong></td><td> <input type="text" placeholder="Company name" name="Supplier_Name"
value="<?php echo $suppliername; ?>"/></td></tr>
<tr><td><strong>Email: </strong></td><td> <input type="text" placeholder="xxxxxx@xxx.xxx" name="Email"
value="<?php echo $email; ?>"/></td></tr>
<tr><td><strong>Address: *</strong></td><td> <input type="text" placeholder="Company address" name="Address"
value="<?php echo $address; ?>"/></td></tr>
<tr><td><strong>Address Code: </strong></td><td> <input type="text" placeholder="99999" name="Address_Code"
value="<?php echo $addresscode; ?>"/></td></tr>
<tr><td><strong>Address City: </strong></td><td> <input type="text" placeholder="State" name="Address_City"
value="<?php echo $addresscity; ?>"/></td></tr>
<tr><td><strong>Person In Charge: </strong></td><td> <input type="text" placeholder="Name person" name="Person_In_Charge"
value="<?php echo $personincharge; ?>"/></td></tr>
<tr><td><strong>Company Phone Number: *</strong></td><td> <input type="text" placeholder="01x-xxxxxxx" name="Company_Phone_No"
value="<?php echo $companyphoneno; ?>"/></td></tr>
</table>
<p>* required</p>
<input type="submit" name="submit" value="Submit" /><p></p>
</div>
</form>
</body>
</html>

<?php }


/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$Supplier_Name = htmlentities($_POST['Supplier_Name'], ENT_QUOTES);
$Email = htmlentities($_POST['Email'], ENT_QUOTES);
$Address = htmlentities($_POST['Address'], ENT_QUOTES);
$Address_Code = htmlentities($_POST['Address_Code'], ENT_QUOTES);
$Address_City = htmlentities($_POST['Address_City'], ENT_QUOTES);
$Person_In_Charge = htmlentities($_POST['Person_In_Charge'], ENT_QUOTES);
$Company_Phone_No = htmlentities($_POST['Company_Phone_No'], ENT_QUOTES);

// check that data required not empty
if ($Supplier_Name == '' || $Email == '' || $Address == '' || $Address_Code == '' || $Address_City == '' || $Person_In_Charge == '' || $Company_Phone_No == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($Supplier_Name, $Email, $Address, $Address_Code, $Address_City, $Person_In_Charge, $Company_Phone_No, $error);
}
else
{
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT supplier (Supplier_Name, Email, Address, Address_Code, Address_City, Person_In_Charge, Company_Phone_No) VALUES ('$Supplier_Name', '$Email', '$Address', '$Address_Code', '$Address_City', '$Person_In_Charge', '$Company_Phone_No')"))
{
$stmt->bind_param("ss", $Supplier_Name, $Email, $Address, $Address_Code, $Address_City, $Person_In_Charge, $Company_Phone_No);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: view1Page.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
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