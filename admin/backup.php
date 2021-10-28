<?php
session_start();
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: index.php");
}
?>

<?php 
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["sql_file"]["name"] != '')
 {
  $array = explode(".", $_FILES["sql_file"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
   include "initialize/config.php";
   $output = '';
   $count = 0;
   $file_data = file($_FILES["sql_file"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($config, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    header("location: backup.php?message=Sorry! there is an error in importing the sql file. Please try again.");
   }
   else
   {
    header("location: backup.php?message=You have successfully imported the SQL data.");
   }
  }
  else
  {
    header("location: backup.php?message=You upload an invalid file please upload .sql file. Please try again.");
  }
 }
 else
 {
    header("location: backup.php?message=Please select a file with a file extension of .sql. Please try again.");
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Dashboard - Admin Management</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">

<?php
if (isset($_GET["message"])) {
  echo"
      <div class='alert alert-success'>
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <h5>".$_GET["message"]."</h5>
      </div>
      ";
}

?>

<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#restore">Restore Database</button>


<a href="actions/backup.php?action=backup" class="btn btn-primary mb-3">Back Up Database</a>

<!-- End of Topbar -->
<table class="table table-bordered mb-0" id="tables">
    <thead>
        <tr class="text-center">
            <th width="50">#</th>
            <th width="50">Table Name</th>
        </tr>
    </thead>
    <tbody>
<?php

    $showtables = mysqli_query($config,"SHOW TABLES");
    $i = 1;
    while ($row = mysqli_fetch_assoc($showtables)) {
        echo '
            <tr class="text-center">
                <th width="50">'.$i++.'</th>
                <td width="50">'.$row['Tables_in_enrollment_system'].'</td>
            </tr>';
    }
?>
</tbody>
</table>
<!--============= Restore Database ==========-->
<div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Restore Database</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<form action="backup.php" method="POST" enctype="multipart/form-data">
<div class="alert-danger p-1 mb-2" style="border-radius: 10px;">
    <strong>NOTE:</strong>
    <p>You are only required to use this feature if you migrate to another database provider or you accidentally delete an important data.</p>
</div>
<div class="custom-file mb-3">
    <label for="username" class="custom-file-label">Database SQL File</label>
    <input type="file" name="sql_file" id="sql_file" class="custom-file-input">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="import" value="Restore">
</div>


</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

</div>
</div>
</div>



<?php include_once "header/footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#tables").DataTable();

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
