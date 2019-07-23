<?php
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$university=$_POST["university"];
$grad=$_POST["grad"];
$comm=$_POST["comm"];
$reasons=$_POST["reasons"];
$experience=$_POST["experience"];
if(!isset($university))
{
    $university="none";

}
if(!isset($grad))
{
    $grad=0;
}
$valid = true;
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name))
    {
        echo "user name contains special characters"."<br>";
        $valid = false;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "user email not valid"."<br>";
        $valid = false;
    }
    if(is_numeric($phone)!=1)
    {
        echo "phone is not valid"."<br>";
        $valid = false;
    }
    if(strlen($phone) > 11 || strlen($phone) < 11)
    {
       echo "phone number is too long or too short"."<br>";
       $valid = false;
    }
    if($valid == false)
    {
        header("Location:form.html");
    }
$con = mysqli_connect("remotemysql.com","I8cDh5BTDS","Da3KankhSE","I8cDh5BTDS");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // escape variables for security
  $name = mysqli_real_escape_string($con, $name);
  $email = mysqli_real_escape_string($con, $email);
  $phone = mysqli_real_escape_string($con, $phone);
  $university = mysqli_real_escape_string($con, $university);
  $grad = mysqli_real_escape_string($con, $grad);
  $comm = mysqli_real_escape_string($con, $comm);
  $reasons = mysqli_real_escape_string($con, $reasons);
  $experience = mysqli_real_escape_string($con, $experience);
  $sql="INSERT INTO register (name, email, univer,phone,exper,reason,grad,comm)
  VALUES ('$name', '$email', '$university','$phone','$experience','$reasons','$grad','$comm')";
  
  if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
  }
  echo "1 record added";
  header("Location:success.html");
  mysqli_close($con);


?>
