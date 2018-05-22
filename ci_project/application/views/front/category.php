<!DOCTYPE html>
<html lang="en">
<?php   $this->load->view('includes/header'); ?>
<body>
    <!-- *** TOPBAR ***-->
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
                        <li>Ladies</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***-->
                    <?php $this->load->view('includes/menu_sidebar'); ?>
                   <?php $this->load->view('includes/brand'); ?>                  
                   <?php $this->load->view('includes/colour'); ?>
                    <!-- *** MENUS AND FILTERS END *** -->
                    <div class="banner">
                        <a href="#">
                            <img src="<?php echo base_url('template'); ?>/img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>
                <?php $this->load->view('includes/cat_product'); ?>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER *** -->
 <?php $this->load->view('includes/footer'); ?>
    <!-- *** SCRIPTS TO INCLUDE ***-->
    <script src="<?php echo base_url('template'); ?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/waypoints.min.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/modernizr.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('template'); ?>/js/front.js"></script>
</body>
</html>