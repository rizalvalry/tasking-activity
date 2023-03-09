<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>2my4edge Bootstrap 3 Table</title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- My Create -->
    <link href="<?= base_url('assets/'); ?>css/mystyle.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.min.css');?>">

    <!-- datepicker -->
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">


	<!-- Bootstrap core JavaScript-->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js');?>"></script>
	<script src="<?=base_url('assets/');?>vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Data Tables -->
	<script src="<?=base_url('assets/');?>vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<script type="text/javascript" src="<?= base_url('assets/');?>ckeditor/ckeditor.js"></script>
	
	<!-- datepickerJS -->
	<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
</head>
<body>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Reg No</th>
                <th>View mark</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($view_data) && is_array($view_data) && count($view_data)): $i=1;
                foreach ($view_data as $key => $data) { 
                ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['nama_project']; ?></td>
                <td><?php echo $data['tenor']; ?></td>
                <td><a data-toggle="modal" data-target="#myModal" 
                  onclick="javascript:load_marks(<?php echo $data['id']; ?>)">View</a>
                </td>
            </tr>
            <?php 
                }
                endif;   
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
//$(".modal-dialog").hide();
function load_marks(id)
{
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('welcome/getmarks');?>",
                data: "id="+id,
                success: function (response) {
                    console.log(response);
                $(".displaycontent").html(response);
                  
                },
                error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
            });
}
</script>

<div class="modal fade displaycontent" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<?php include('modal.php'); ?>

</div>

</body>
</html>             