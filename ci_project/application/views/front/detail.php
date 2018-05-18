<!DOCTYPE html>
<html lang="en">
<?php   $this->load->view('includes/header'); ?>
<body>
    <!-- *** TOPBAR ***-->
<?php $this->load->view('includes/top_navbar'); ?>
    <!-- *** TOP BAR END *** -->
    <!-- *** NAVBAR **-->
<?php $this->load->view('includes/navbar'); ?>
    <!-- *** NAVBAR END *** -->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Ladies</a>
                        </li>
                        <li><a href="#">Tops</a>
                        </li>
                        <li>White Blouse Armani</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***-->
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>
                        <?php $this->load->view('includes/category_left'); ?>
                    </div>
                    <?php $this->load->view('includes/brand'); ?>
                    <?php $this->load->view('includes/colour'); ?>

                    <!-- *** MENUS AND FILTERS END *** -->
                </div>
                <div class="col-md-9">
                    <?php $this->load->view('includes/view_detail'); ?>
                   
                    <?php $this->load->view('includes/descript_detail'); ?>
                   <!-- Detail product --> 
                   <?php $this->load->view('includes/detail'); ?>
                   <?php $this->load->view('includes/detail'); ?>
                    <!-- End Detail product -->                  
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER ***-->
<?php $this->load->view('includes/footer'); ?>
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
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