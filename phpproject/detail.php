
<?php 
  include_once('./db/dbconf.php');
  include_once('./class/class.crud.php');
  $objCrud = new crud($DB_con);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/header.php') ?>
  <style type="text/css">
    .pull-right{
      right: 0;
      float: right;
    }
  </style>
  <body>
    <!-- Navigation -->
    <?php include_once('includes/navbar.php') ?>
    <!--slide-->
    <?php include_once('includes/slider.php') ?>
      <!--End slide-->
    <!-- Page Content -->
<div class="container-fluid" >
<div class="col-lg-12">
<div class="row">
  <div class="banner-bootom-w3-agileits">
    <?php include_once('includes/view_detail.php') ?>
  </div>
      <?php// include_once('includes/view_page.php') ?>
   

          <!-- /.row -->
          </div>
        <!-- /.col-lg-9 -->
      </div>
    </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>

</html>
