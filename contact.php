<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>
  <style type="text/css">
    .pull-right{
      right: 0;
      float: right;
    }
  </style>
  <body>
    <!-- Navigation -->
    <nav style="background-color: #0079c1" class="navbar navbar-expand-lg navbar-dark fixed-top">
      
      <div class="container">
        <a class="navbar-brand" href="index.php">Group 2 <img src="image/logo2.png" alt="image"> </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <h5>
            <li class="nav-item active">              
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>            
            </li>
            </h5>
            <h5>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            </h5>
            <h5>
            <li class="nav-item">
              <a class="nav-link" href="product.php">product</a>
            </li>
            </h5>
            <h5>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            </h5>
          </ul>
        </div>
      </div>
    </nav>
  </nav>
    <!--slide-->
     <div class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="height: 400px">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="image/banner1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="image/banner2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="image/banner3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </div>
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
          ​<div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categories
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
            <li><a href="#">Electroic</a></li>
            <li><a href="#">Ladies Wears</a></li>
            <li><a href="#">Men Wears</a></li>
            <li><a href="#">Kids Wears</a></li>
            <li><a href="#">Furnitures</a></li>
            <li><a href="#">Home Appliance</a></li>
            <li><a href="#">Electronic Gadget</a></li>
            </ul>
          </div>
        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
         <div class="row">
          <div class="col-lg-12" style="background-color: #0079c1">
          <h4 style="text-align: center;">View page</h4>
          <iframe class="col-lg-12" height="500px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15524.979156752002!2d103.75245322074166!3d13.397163599241713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDIzJzQ5LjgiTiAxMDPCsDQ1JzQwLjQiRQ!5e0!3m2!1sen!2sin!4v1524582723794" allowfullscreen></iframe>
          </div>
         </div> 

          
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
