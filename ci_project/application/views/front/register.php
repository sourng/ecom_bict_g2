<!DOCTYPE html>
<html lang="en">
<?php   $this->load->view('includes/header'); ?>
<body>
      <!-- *** TOPBAR *** -->
<?php $this->load->view('includes/top_navbar'); ?>
    <!-- *** TOP BAR END *** -->

  <!-- *** NAVBAR ***-->
<?php $this->load->view('includes/navbar'); ?>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>
                </div>
                <?php $this->load->view('includes/registers'); ?>
                <?php $this->load->view('includes/logins'); ?>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER ***-->
       <?php $this->load->view('includes/footer'); ?>
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="<?php echo base_url('template');?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url('template');?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('template');?>/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url('template');?>/js/waypoints.min.js"></script>
    <script src="<?php echo base_url('template');?>/js/modernizr.js"></script>
    <script src="<?php echo base_url('template');?>/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?php echo base_url('template');?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('template');?>/js/front.js"></script>



</body>

</html>
