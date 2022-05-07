<?php
include'dbconnect.php';
//    PRINT_R($_GET['S_no']);

   

if(isset($_GET['S_no'])){
    $sno=$_GET['S_no'];

$sql="DELETE FROM Notes WHERE `S.no`=$sno";
$result=mysqli_query($connect,$sql);
header("location:Tabularform.php");
}





?>