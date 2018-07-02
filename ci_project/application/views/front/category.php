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

    <script>
            $(document).ready(function(){
             
             $('.add_cart').click(function(){
              var pro_id = $(this).data("pro_id");
              var pro_name = $(this).data("pro_name");
              var price = $(this).data("price");
              var pro_feature = $(this).data("pro_feature");
              // var img = $(this).data("img");

              // var quantity = $('#' + product_id).val();
              var quantity = 1;
              if(quantity != '' && quantity > 0)
              {
               $.ajax({
                url:"<?php echo base_url(); ?>shopping/add",
                method:"POST",
                data:{pro_id:pro_id, pro_name:pro_name, price:price, quantity:quantity,pro_feature:pro_feature},
                success:function(data)
                {
                 alert("Product Added into Cart");
                 $('#cart_details').html(data);
                 $('#' + pro_id).val('');

                 $(".cartcount").text(data);
                }
               });
              }
              else
              {
               alert("Please Enter quantity");
              }
             });

             $('#cart_details').load("<?php echo base_url(); ?>shopping_cart/load");

             $(document).on('click', '.remove_inventory', function(){
              var row_id = $(this).attr("id");
              if(confirm("Are you sure you want to remove this?"))
              {
               $.ajax({
                url:"<?php echo base_url(); ?>shopping_cart/remove",
                method:"POST",
                data:{row_id:row_id},
                success:function(data)
                {
                 alert("Product removed from Cart");
                 $('#cart_details').html(data);
                 $(".cartcount").text(data);
                }
               });
              }
              else
              {
               return false;
              }
             });

             $(document).on('click', '#clear_cart', function(){
              if(confirm("Are you sure you want to clear cart?"))
              {
               $.ajax({
                url:"<?php echo base_url(); ?>shopping_cart/clear",
                success:function(data)
                {
                 alert("Your cart has been clear...");
                 $('#cart_details').html(data);

                 $(".cartcount").text(data);
                }
               });
              }
              else
              {
               return false;
              }
             });

            });
</script>
</body>
</html>