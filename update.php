<?php
include 'dbconnect.php';
// PRINT_R($_GET);
if(!empty($_GET['S_no'])){


$serialNo=$_GET['S_no'];
$showquery="SELECT * FROM `Notes` where `S.no`=$serialNo";
$sql =mysqli_query($connect,$showquery);
$arraydata=mysqli_fetch_array($sql); 
}
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Notes</title>
    <style>
 .add{
     background:none;
     padding:8px;  
     border:0;
     background:blue;
     border-radius:10px;
     float:right;
     margin-right: 20px;
     position:relative;
     top:-40px;
 }
 
 
 .add a{
     color:white;
     text-decoration:none;
 }
 .btn a{
 color:white;
 text-decoration:none;
 }
    </style>
</head>

<body>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
     
   
   

   
    $Title=$_POST['title'];
    $Description=$_POST['Desc'];
    // $insert="INSERT INTO `Notes`(`Title`,`Description`) VALUES('$Title','$Description')";
    // $result=mysqli_query($connect,$insert);
    // if($result){
    //     $inserted=true;
    // }
    
        $id=$_POST['sno'];
        echo $id;
        $query="UPDATE `Notes` SET `Title`='$Title',`Description`= '$Description' WHERE `Notes`.`S.no`='$id' ";
        $res=mysqli_query($connect,$query);
        header("location:Tabularform.php");
        
    

}
?>
   
    <h3>Update Note!</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
    <input type="hidden" name="sno" id="sno" value="<?php echo $arraydata['S.no'];?>">
        <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="title" value="<?php echo $arraydata['Title'];?>" name="title" aria-describedby="emailHelp">

        </div>
        <div class="mb-3">
            <label for="Desc" class="form-label">Notes Description</label>
            <input type="text" class="form-control" id="Desc" value="<?php echo $arraydata['Description'];?>" name="Desc"></input>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update Note</button>
      
    </form>
    </div>
    <div>
  <button class="add"><a href="Tabularform.php">Know More</a></button>
</div>

 






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>



