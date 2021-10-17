<?php include '../database/connect.php'; ?>
<?php
if (isset($_COOKIE['admin'])){
  $id = $_COOKIE['admin'];
}else{
  echo "<script>window.location.replace('index.php')</script>";
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin - Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="../x/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../x/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/font-awesome.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/test.css" type="text/css" media="all">
  <link href="../x/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body id="page-top" style="background-color: white">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $user = json_decode(get_cust()); ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>
        <!-- Heading -->
        <div class="sidebar-heading">
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage Users</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Profile</h6>
              <a class="collapse-item" href="users.php">Users Profile</a>
            </div>
          </div>
        </li>
        <!-- Heading -->
        <div class="sidebar-heading">

        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Manage Questions</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="code.php">manage question code</a>
              <a class="collapse-item" href="questions.php">Add a question</a>
              <a class="collapse-item" href="comprehension.php">Add/edit comprehension</a>
              <a class="collapse-item" href="edit_questions.php">Edit/Delete Question</a>
              <div class="collapse-divider"></div>
            </div>
          </div>
        </li>
        <div class="sidebar-heading">

        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Messaging</span>
          </a>
          <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="message.php">Send a message</a>
              <a class="collapse-item" href="mail.php">Send a mail</a>
              <div class="collapse-divider"></div>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publications.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage Publications</span>
          </a>
          <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Profile</h6>
              <a class="collapse-item" href="users.php">Users Profile</a>
            </div>
          </div> -->
          <!-- Sidebar Toggler (Sidebar) -->
          <!-- <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div> -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="instructions.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage instructions</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="games.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage Games</span>
          </a>
        </li>
      </ul>
      <!-- End of Sidebar -->
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
              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Messages -->
                  <?php
                  $sql = $db->query("SELECT * FROM message WHERE status = 'unread' AND rid = '0'");
                  if ($sql->num_rows > 0) {
                    $num = $sql->num_rows;
                    ?>
                    <span class="badge badge-danger badge-counter"><?=$num?></span>
                  <?php }else{ ?>
                    <span class="badge badge-danger badge-counter">0</span>
                  <?php } ?>
                </a>
                <!--  Messages  -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Message Center
                  </h6>
                  <?php
                  $d = dashmess();
                  $dec = json_decode($d);
                  if (!empty($dec)) {
                    foreach ($dec as $d) {
                      $mid = $d->id;
                      $sid = $d->sid;
                      ?>
                      <a class="dropdown-item d-flex align-items-center" href="admin_message.php?id=<?=$mid?>">
                        <div class="dropdown-list-image mr-3">
                          <?php if ($d->status == 'unread') { ?>
                            <i class="fas fa-envelope"></i>
                          <?php }else{ ?>
                            <i class="fas fa-envelope-open-text"></i>
                          <?php } ?>
                        </div>
                        <div class="font-weight-bold">
                          <div class="text-truncate"><?=$d->subject?></div>
                          <div class="small text-gray-500"><?=$d->s_name?></div>
                        </div>
                      </a>
                    <?php  }
                  } ?>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
              </li>
              <div class="topbar-divider d-none d-sm-block"></div>
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome Back, <?=$adminname?></span>
                  <img class="img-profile rounded-circle" src="../x/img/profile.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <div id="snackbar"></div>