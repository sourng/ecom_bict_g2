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
  <?php include_once('includes/navbar.php') ?>
    <!--slide-->
     <div class="container-fluid">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3881.446769403083!2d103.77025079948223!3d13.38463933796815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31101057a73dab2f%3A0x7f0148d3468ee26e!2sUnnamed+Road%2C+Cambodia!5e0!3m2!1sen!2sus!4v1527871703458" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <!--End slide-->
<div class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Siem Reap,Cambodia </p>
      <p><span class="glyphicon glyphicon-phone"></span> +855967585037</p>
      <p><span class="glyphicon glyphicon-envelope"></span> kanhapc.com@gmail.com</p> 
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <label for="Name">Contact Name</label>
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <label for="Email">Email Contact</label>
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-primary pull-right" type="submit">SEND US</button>
        </div>
      </div> 
    </div>
  </div>
</div>
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
