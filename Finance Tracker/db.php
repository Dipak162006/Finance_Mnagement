<?php 
session_start();
  $host="localhost";
  $uname="root";
  $pass="";
  $db="expance_db";
  $conn = mysqli_connect($host,$uname,$pass,$db);
  if(!$conn)
  {
    echo "connection failed ";
  }
?>