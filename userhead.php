<?php include 'database/connect.php'; ?>
<?php if (isset($_COOKIE['uid'])){
  $id = $_COOKIE['uid'];
}else{
  echo "<script>window.location.replace('login.php')</script>";
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
  <title>DnDChallenge User - Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="x/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="x/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/test.css" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f0c16a967771f3813c0ec7b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $user = json_decode(get_cust()); ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
           <img src="images/logo1.png" width="150px"/>
        </div>
      </a>
      <!-- Divider -->
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <!-- Heading -->
        <div class="sidebar-heading">

        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Profile</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">User Profile</h6>
              <a class="collapse-item" href="profile.php">Profile</a>
            </div>
          </div>
        </li>
        <!-- Divider -->
        <!-- Heading -->
        <div class="sidebar-heading">

        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Contact Us</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="contact.php">Send a message</a>
              <a class="collapse-item" href="tel:07031215032">070-3333-3333</a>
              <a class="collapse-item" href="mailto:email@example.com">mail us</a>
              <div class="collapse-divider"></div>
            </div>
          </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
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

              <!-- Nav Item - Alerts -->
              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages  -->
                  <?php
                  $sql = $db->query("SELECT * FROM message WHERE rid = $id and status = 'unread'");
                  if ($sql->num_rows > 0) {
                    $num = $sql->num_rows;
                    ?>
                    <span class="badge badge-danger badge-counter"><?=$num?></span>
                  <?php }else{ ?>
                    <span class="badge badge-danger badge-counter">0</span>
                  <?php } ?>
                </a>
                <!--  Dropdown - Messages  -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Message Center
                  </h6>
                  <?php
                  $d = mess($id);
                  $dec = json_decode($d);
                  if (!empty($dec)) {
                    foreach ($dec as $d) {
                      $mid = $d->id;
                      ?>
                      <a class="dropdown-item d-flex align-items-center" href="read.php?id=<?=$mid?>">
                        <div class="dropdown-list-image mr-3">
                          <?php if ($d->status == 'unread') { ?>
                            <i class="fas fa-envelope"></i>
                          <?php }else{ ?>
                            <i class="fas fa-envelope-open-text"></i>
                          <?php } ?>
                        </div>
                        <div class="font-weight-bold">
                          <div class="text-truncate"><?=$d->subject?></div>
                          <div class="small text-gray-500">GamesHub</div>
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
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome Back, <?=$username?></span>
                  <img class="img-profile rounded-circle" src="<?php if($user->picture == ''){echo 'x/img/profile.png';}else{echo $user->picture;} ?>">
                </a>
                <!-- Dropdown - User In;formation -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
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