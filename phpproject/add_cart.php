
<?php 
  include_once('./db/dbconf.php');
  include_once('./class/class.crud.php');
  $objCrud = new crud($DB_con);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/header.php'); ?>
  <style type="text/css">
    .pull-right{
      right: 0;
      float: right;
    }
  </style>
  <body>
    <!-- Navigation -->
    <?php include_once('includes/navbar.php'); ?>
    <!--slide-->
    <?php include_once('includes/slider.php'); ?>
      <!--End slide-->
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h5>KANHA</h5>
          <h5>ANH</h5>
          <h5>SREYMOM</h5>
          <!--<div class="list-group">
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
          </div>-->
          ​<?php include_once('includes/drop_down_menu.php'); ?>
        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
        <div class="row">
            <?php// include_once('includes/view_page.php'); ?>
            
  
    
      <h2>Check Out</h2>
                   
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Discount</th>
              <th>Tola</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John</td>
              <hr>
              <td>Doe</td>
              <hr>
              <td>2</td>
              <hr>
              <td>3</td>
              <hr>
              <td>3</td>
              <hr>
              <span class="glyphicon glyphicon-trash"></span>
            </tr>
            <tr>
              <td>Mary</td>
              <hr>
              <td>Moe</td>
              <hr>
              <td>3</td>
              <hr>
              <td>3</td>
              <hr>
              <td>3</td>
              <hr>
              <span class="glyphicon glyphicon-trash"></span>
            </tr>
            <tr>
              <td>July</td>
              <hr>
              <td>Dooley</td>
              <hr>
              <td>4</td>
              <hr>
              <td>3</td>
              <hr>
              <td>3</td>
              <hr>
              <span class="glyphicon glyphicon-trash"></span>
            </tr>

          </tbody>
        </table>
    
  

          <!-- /.row -->
          </div>
        <!-- /.col-lg-9 -->
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







