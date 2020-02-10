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
    border: 1px solid black;
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
	 
     <button type="button" class="btn btn-home"><a href = "mainPageSupervisor.html">Home</a></button>
     <button type="button" class="btn btn-system"><a href = "systemPageSupervisor.html">System</a></button>
	 <button type="button" class="btn btn-logout"><a href = "htmlloginFirst.html" onclick='return confirm();'>Logout</a></button>

	 
	 </p>
	 
</header>
<head>
<title>List Supplier</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<br>
<nav id="system" class="container-fluid">
<body>

<h1>List Supplier</h1>

<p><b>View All</b> | <a href="view-paginated1PageSupervisor.php">View Paginated</a></p>

<?php
// connect to the database
include('connect-db.php');

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM supplier ORDER BY Supplier_ID"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>Supplier Name</th><th>Email</th><th>Address</th><th>Code</th><th>City</th><th>Person In Charge</th><th>Phone No.</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->Supplier_ID . "</td>";
echo "<td>" . $row->Supplier_Name . "</td>";
echo "<td>" . $row->Email . "</td>";
echo "<td>" . $row->Address . "</td>";
echo "<td>" . $row->Address_Code . "</td>";
echo "<td>" . $row->Address_City . "</td>";
echo "<td>" . $row->Person_In_Charge . "</td>";
echo "<td>" . $row->Company_Phone_No . "</td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>
<p></p>
</nav>
</body>

<br>

<footer>

FR RETAIL SHOP INVENTORY SYSTEM

</footer>

</nav>
</html>