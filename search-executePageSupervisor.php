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
	 
     <button type="button" class="btn btn-home"><a href = "mainPageSupervisor.html">Home</a></button>
     <button type="button" class="btn btn-system"><a href = "systemPageSupervisor.html">System</a></button>
	 <button type="button" class="btn btn-logout"><a href = "htmlloginFirst.html" onclick="return confirm();">Logout</a></button>

	 
	 </p>
	 
</header>
<head><title>Search Data</title>
</head>

<br>
<nav id="system" class="container-fluid">
<body>

<?php

echo "<h2>Search Results:</h2><p>";
$find=$_POST['find'];
//If they did not enter a search term we give them an error
if ($find == "")
{
echo "<p>You forgot to enter a search term !!!";
}

// server info
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'inventory';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

// We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);

$field=$_POST['field'];
//Now we search for our search term, in the field the user specified
if ($result = $mysqli->query("SELECT * FROM product WHERE upper($field) LIKE'%$find%'"))
{
//And we display the results
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>Product ID</th><th>Product Name</th><th>Type</th><th>Type ID</th><th>Supplier Name</th><th>Quantity</th><th>Location</th><th>Unit Buy (RM)</th><th>Unit Sell (RM)</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->Product_ID . "</td>";
echo "<td>" . $row->Product_Name . "</td>";
echo "<td>" . $row->Type . "</td>";
echo "<td>" . $row->Type_ID . "</td>";
echo "<td>" . $row->Supplier_ID . "</td>";
echo "<td>" . $row->Quantity . "</td>";
echo "<td>" . $row->Location . "</td>";
echo "<td>" . $row->Unit_Buy . "</td>";
echo "<td>" . $row->Unit_Sell. "</td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "<p>No results to display!</p>";
}

//And we remind them what they searched for
echo "<b>Searched For:</b> " .$find;
}

// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>

<p><button onclick="window.print()">Print</button></p>
</nav>
</body>

<br>

<footer>

FR RETAIL SHOP INVENTORY SYSTEM

</footer>

</nav>
</html>