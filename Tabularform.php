<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
    <title>Document</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: coral;
    }
    .glyphicon{
          margin:4px;
    }
    .Note{
        margin:10px;
    }
    
    </style>
</head>

<body>
    <?php
 include 'dbconnect.php';
 ?>
   <?php
$selectrows="SELECT * FROM `Notes`";
$result=mysqli_query($connect,$selectrows);

?>

<a href="first.php" class="btn btn-primary  Note" > Add Notes</a>
    <table class="table">
        <tr>
            <th>S.no</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <a href=""></a>
        <?php
        include 'delete.php'; 
          $seno=0;
        while($row=mysqli_fetch_assoc($result)){
          $seno++;
          echo ' 
          <tr>
          <td>'.$seno.'</td>
          <td>'.$row['Title'] .'</td>
          <td>'.$row['Description'] .'</td>
          <td>';
          
         
         echo '<a href="delete.php?S_no='.$row['S.no'].'" ><span class=" glyphicon glyphicon-trash" ></span></a>
          <a href="update.php?S_no='.$row['S.no'].'" ><span class=" glyphicon glyphicon-pencil" ></span></a>
          
           </td>
          
          
        </tr>';

        }
        
      
 ?>


    </table>
 


   
</body>

</html>