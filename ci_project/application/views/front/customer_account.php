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
                        <li>My account</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="customer-orders.html"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="customer-wishlist.html"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                <li>
                                    <a href="customer-account.html"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="index.html"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

               <?php $this->load->view('includes/my_account'); ?>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER ***
 _________________________________________________________ -->
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
