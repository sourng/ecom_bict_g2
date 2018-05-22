<!DOCTYPE html>
<html lang="en">
<?php   $this->load->view('includes/header'); ?>
<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
  <?php $this->load->view('includes/top_navbar'); ?>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->
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
                        <li>Checkout - Order review</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <?php $this->load->view('includes/checkout_order_view4'); ?>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-md-9 -->
                <?php $this->load->view('includes/order_sumary'); ?>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER ***
 _________________________________________________________ -->
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