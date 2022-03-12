<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
 ?>


<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_pw'])) {
	echo "<meta http-equiv='refresh' content='0; url=http://funware.shop/admin/src/login.php'>";
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Funware Admin Console</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <link href="css/addons/datatables.min.css" rel="stylesheet">

</head>
<style>
  input[type=text] {
    color: black;
    border: none;
    background: aliceblue;
  }
  input[type=date] {
    color: black;
    border: none;
    background: aliceblue;
  }
  #sidebar{
    position:fixed;
  }
  @media (min-width: 991px){
.main-panel{
  position: absolute;
  margin-left:270px;
  }
}

</style>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="main.php">
          <img src="assets/images/logo.svg" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="main.php">
          <img src="assets/images/logo-mini.svg" alt="logo" /> </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +8210 8559 2680</li>

        </ul>


        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
              <img class="img-xs rounded-circle" src="../../../img/cat.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
              <?php
 echo '<p class="profile-name">'.$_SESSION['user_id'].'</p>';
?>
                <p class="designation">Premium user</p>
              </div>
            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="main.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Main</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="project.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Project</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payment.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Payment History</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notice.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Notice/Event</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="etp.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Enterprise</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">login</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
              <div class="page-header">
                <h4 class="page-title">Notice</h4>
                <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                </div>
              </div>



              <!-- Page Title Header Ends-->


              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Invoice</h4>

                          </div>
                          <p>Notice Table</p>
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                  cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th class="th-sm">ai_notice

                                      </th>
                                      <th class="th-sm">f_div

                                      </th>
                                      <th class="th-sm">f_ne

                                      </th>
                                      <th class="th-sm">f_notice_title

                                      </th>
                                      <th class="th-sm">f_notice_contents

                                      </th>
                                      <th class="th-sm">f_notice_img

                                      </th>
                                      <th class="th-sm">f_date

                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                  $q4= $db->query('SELECT * FROM tbl_notice'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["ai_notice"].'</td>';
                                      echo '<td>'.$row["f_div"].'</td>';
                                      echo '<td>'.$row["f_ne"].'</td>';
                                      echo '<td>'.$row["f_notice_title"].'</td>';
                                      echo '<td><textarea name="f_notice_contents" cols="70" rows="4">'.$row["f_notice_contents"].'</textarea></td>';
                                      echo '<td>'.$row["f_notice_img"].'</td>';
                                      echo '<td>'.$row["f_date"].'</td>';
                                    echo '</tr>';
                                  }
                                ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Invoice</h4>

                          </div>
                          <p>Notice Table</p>
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="table-responsive">
                                <table id="dtBasicExample3" class="table table-striped table-bordered table-sm"
                                  cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th class="th-sm">ai_notice

                                      </th>
                                      <th class="th-sm">Y/N

                                      </th>
                                      <th class="th-sm">N/E

                                      </th>
                                      <th class="th-sm">f_notice_title

                                      </th>
                                      <th class="th-sm">f_notice_contents

                                      </th>
                                      <th class="th-sm">f_notice_img

                                      </th>
                                      <th class="th-sm">f_date

                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                  $q4= $db->query('SELECT * FROM tbl_notice'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["ai_notice"].'</td>';                    
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input style="width:2em;" type="text" name="f_div" value='.$row["f_div"].'> <input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input style="width:2em;" type="text" name="f_ne" value='.$row["f_ne"].'> <input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input type="text" name="f_notice_title" value="'.$row["f_notice_title"].'"> <input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td><form action="update/update_notice.php" method="post"><textarea name="f_notice_contents" cols="70" rows="4">'.$row["f_notice_contents"].'</textarea><input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset;" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                      echo '<td>'.'<form action="update/update_notice.php" method="post" enctype="multipart/form-data"><input type="file" name="f_notice_img" value='.$row["f_notice_img"].'> <input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input type="date" name="f_date" value='.$row["f_date"].'> <input type="hidden" name="ai_notice" value='.$row["ai_notice"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                    echo '</tr>';
                                  }
                                ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Invoice</h4>

                          </div>
                          <p>INSERT Notice Table</p>
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm"
                                  cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th class="th-sm">Y/N

                                      </th>
                                      <th class="th-sm">N/E

                                      </th>
                                      <th class="th-sm">f_notice_title

                                      </th>
                                      <th class="th-sm">f_notice_contents

                                      </th>
                                      <th class="th-sm">f_notice_img

                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <form action="update/insert_notice.php" method="post" enctype="multipart/form-data">  
                                      <tr>                
                                        <td><input style="width:2em;" type="text" name="f_div" value='Y'></td>
                                        <td><input style="width:2em;" type="text" name="f_ne" value='N'></td>
                                        <td><input type="text" name="f_notice_title" value='제목'></td>
                                        <td><textarea name="f_notice_contents" cols="70" rows="4">내용</textarea></td>
                                        <td><input type="file" name="f_notice_img" value=''></td>
                                      </tr>
                                      <button style="all:unset" type="submit"><i class="fa fa-save"></i></button>
                                    </form> 
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Invoice</h4>

                          </div>
                          <p>Notice Dat Table</p>
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="table-responsive">
                              <table id="dtBasicExample2" class="table table-striped table-bordered table-sm" cellspacing="0"
                      width="100%">
                      <thead>
                        <tr>
                          <th class="th-sm">Y/N

                          </th>
                          <th class="th-sm">sys_notice_id

                          </th>
                          <th class="th-sm">sys_user_id

                          </th>
                          <th class="th-sm">f_notice_title

                          </th>
                          <th class="th-sm">f_dat

                          </th>
                          <th class="th-sm">auto_date

                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                                  $q4= $db->query('SELECT tbl_notice_dat.f_div AS p_div
                                                          ,sys_notice_id
                                                          ,sys_user_id
                                                          ,f_notice_title
                                                          ,auto_date 
                                                          ,ai_dat_id
                                                          ,f_dat
                                                      FROM tbl_notice_dat
                                                      LEFT JOIN tbl_notice
                                                        ON tbl_notice_dat.sys_notice_id = tbl_notice.ai_notice'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';                  
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input style="width:2em;" type="text" name="p_div" value='.$row["p_div"].'> <input type="hidden" name="ai_dat_id" value='.$row["ai_dat_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.$row["sys_notice_id"].'</td>'; 
                                      echo '<td>'.$row["sys_user_id"].'</td>'; 
                                      echo '<td>'.$row["f_notice_title"].'</td>'; 
                                      echo '<td><form action="update/update_notice.php" method="post"><textarea name="f_dat" cols="70" rows="4">'.$row["f_dat"].'</textarea><input type="hidden" name="ai_dat_id" value='.$row["ai_dat_id"].'><button style="all:unset;" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                      echo '<td>'.'<form action="update/update_notice.php" method="post"><input type="date" name="auto_date" value='.$row["auto_date"].'> <input type="hidden" name="ai_dat_id" value='.$row["ai_dat_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                    echo '</tr>';
                                  }
                                ?>
                      </tbody>
                    </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- </div>
   -->
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="container-fluid clearfix">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
        bootstrapdash.com 2020</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
          href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
          templates</a> from Bootstrapdash.com</span>
    </div>
  </footer>
  <!-- partial -->

  <!-- main-panel ends -->

  <!-- page-body-wrapper ends -->

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="assets/js/shared/off-canvas.js"></script>
  <script src="assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/demo_1/dashboard.js"></script>
  <!-- End custom js for this page-->

  <script type="text/javascript" src="js/addons/datatables.min.js"></script>
  <script>
    $(document).ready(function () {

      $('.dataTables_length').addClass('bs-select');
      $('#dtBasicExample').DataTable({

        "responsive": true
      });
    });
    $(document).ready(function () {

      $('.dataTables_length').addClass('bs-select');
      $('#dtBasicExample2').DataTable({

        ordering: false,
        "responsive": true
      });
    });
    $(document).ready(function () {

$('.dataTables_length').addClass('bs-select');
$('#dtBasicExample3').DataTable({

  ordering: false,
  "responsive": true
});
});
  </script>
</body>

</html>