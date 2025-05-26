<?php


$username=$_POST['username'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];















$conn=new mysqli('localhost','root','','regis');
if($conn ->connect_error){
 
  die( 'connection faild '.$conn->connect_error);

}else{

  $stmt =$conn->prepare("insert into users(username,email,gender,password,repassword)
  values(?,?,?,?,?)");

  $stmt->bind_param("sssss", $username,$email,$gender,$password,$repassword);
  $stmt->execute();
  echo "registration succesfull";
  $stmt->close();
  $conn->close();



}


?>