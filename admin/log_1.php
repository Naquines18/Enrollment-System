<?php
session_start();
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: index.php");
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




<!-- End of Topbar -->
<table class="table table-bordered mb-0" id="tables">
    <thead>
        <tr class="text-center">
            <th>#</th>
            <th>User</th>
            <th>Type</th>
            <th>Action</th>
            <th>Date Log Created</th>
        </tr>
    </thead>
    <tbody>
<?php
    $showtables = mysqli_query($config,"SELECT * FROM admin_registrar_log ORDER BY date_log DESC");
    $i = 1;
    while ($row = mysqli_fetch_assoc($showtables)) {

        $is_edit = ($row['type'] == "Edit")? 'bg-secondary text-white':'bg-dark text-white';
        $is_type_edit = ($row['type'] == "Edit")? 'badge badge-secondary':'badge badge-dark';

        $is_same = ($row['user'] == $_SESSION['username'])? 'badge badge-info':'badge badge-dark';

        echo '
            <tr class="text-center">
                <th>'.$i++.'</th>
                <td><span class="'.$is_same.'">'.$row['user'].'</span></td>
                <td><span class="'.$is_type_edit.'">'.$row['type'].'</span></td>
                <td class="'.$is_edit.'">'.$row['action'].'</td>
                <td class="'.$is_edit.'">'.$row['date_log'].'</td>
            </tr>';
    }
?>
</tbody>
</table>


<?php include_once "header/footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#tables").DataTable();
    });
</script>
