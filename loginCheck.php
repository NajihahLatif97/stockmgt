<?php 
require ('sql_connect.php'); 
if (isset($_POST['submit'])){ 
$username= $_POST['uname']; 
$password= $_POST['pass']; 
if (!$_POST['uname'] | !$_POST['pass'])  
{ 
echo ("<SCRIPT LANGUAGE='JavaScript'>         
window.alert('You did not complete all of the required fields')         
window.location.href='htmlloginFirst.html'         
</SCRIPT>"); 
exit();      
} 
$sql= "SELECT * FROM `login_users` WHERE `username` = '$username' AND `password` = '$password'"; 
$query = $connect->query($sql);
if($query->num_rows > 0) 
{ 
echo ("<SCRIPT LANGUAGE='JavaScript'>         
window.alert('Login Succesfully!')         
window.location.href='mainPage.html'         
</SCRIPT>"); 
exit(); 
} 
else
{ 
echo ("<SCRIPT LANGUAGE='JavaScript'>         
window.alert('Wrong username password combination.Please re-enter.')         
window.location.href='htmlloginFirst.html'         
</SCRIPT>"); 
exit();
 } 
 } 
 else{ 
 } 
 ?>   