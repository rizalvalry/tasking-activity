<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

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

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper"> 

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-code"></i>
    </div>
    <div class="sidebar-brand-text mx-3">V House</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">


<!-- QUERY MENU -->
<?php 
$role_id = $this->session->userdata('role_id');
// var_dump($role_id); die();
if($role_id == NULL) {
    redirect('auth');
} else {
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                      ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                   WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_access_menu`.`menu_id` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
}
?>


<!-- LOOPING MENU -->
<?php foreach ($menu as $m) : ?>
<div class="sidebar-heading">
    <?= $m['menu']; ?>
</div>

<!-- SIAPKAN SUB-MENU SESUAI MENU -->
<?php 
$menuId = $m['id'];
$querySubMenu = "SELECT *
                   FROM `user_sub_menu` JOIN `user_menu` 
                     ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                  WHERE `user_sub_menu`.`menu_id` = $menuId
                    AND `user_sub_menu`.`is_active` = 1
            ";
$subMenu = $this->db->query($querySubMenu)->result_array();
?>

<?php foreach ($subMenu as $sm) : ?>
<?php if ($title == $sm['title']) : ?>
<li class="nav-item active">
    <?php else : ?>
<li class="nav-item">
    <?php endif; ?>
    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
        <i class="<?= $sm['icon']; ?>"></i>
        <span><?= $sm['title']; ?></span></a>
</li>
<?php endforeach; ?>

<hr class="sidebar-divider mt-3">

<?php endforeach; ?>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Logout</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End  of Sidebar --> 

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar --> 





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


                
            <!-- Main Menu Utama -->
                        <div class="content-wrapper">
                        <?= $contents; ?>
                        </div>
            <!-- End Main Menu Utama -->


      
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ValryHouse <?=date('Y');?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?=base_url('auth/logout');?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            


            <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js');?>"></script>
            <!-- Core plugin JavaScript-->
            <script src="<?=base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>
            <!-- Custom scripts for all pages-->
            <script src="<?=base_url('assets/');?>js/sb-admin-2.min.js"></script>

            <script>
                $('.custom-file-input').on('change', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });



                $('.form-check-input').on('click', function() {
                    const menuId = $(this).data('menu');
                    const roleId = $(this).data('role');

                    $.ajax({
                        url: "<?=base_url('admin/changeaccess');?>",
                        type: 'post',
                        data: {
                            menuId: menuId,
                            roleId: roleId
                        },
                        success: function() {
                            document.location.href = "<?=base_url('admin/roleaccess/');?>" + roleId;
                        }
                    });

                });

                // Ck Editor
                // CKEDITOR.replace('description');
            </script>




</body>

</html>