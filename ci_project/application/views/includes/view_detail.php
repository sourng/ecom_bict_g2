<?php foreach ($lastcartid as $row) {
    $lastcartid=$row['lastcartid'];
} ?>
<?php foreach ($detail as $row) { ?>
<div class="row" id="productMain">


  <form id="detailCartForm" action="<?php echo site_url(); ?>shopping/add"  method="POST" accept-charset="utf-8">

    <input type="hidden" name="id" id="<?php echo $row['pro_id']; ?>" value="<?php echo $row['pro_id']; ?>">
    <input type="hidden" name="pro_name" id="<?php echo $row['pro_name']; ?>" value="<?php echo $row['pro_name']; ?>">

        <input type="hidden" name="price" id="<?php echo $row['price']; ?>" value="<?php echo $row['price']; ?>">
    <input type="hidden" name="img" id="<?php echo $row['pro_feature']; ?>" value="<?php echo $row['pro_feature']; ?>">
     <input type="hidden" name="discount" id="<?php echo $row['discount']; ?>" value="<?php echo $row['discount']; ?>">
    



                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="<?php echo base_url("upload/product/".$row['pro_feature']); ?>" alt="" style="width: 100%;height: 400px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="text-center"><?php echo $row['pro_name'] ?></h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                                </p>
                                <p class="price">$<?php echo $row['price'] ?></p>

                                <p class="text-center buttons">
                                     <!-- <a onclick="increment_quantity(<?php  //echo $lastcartid?>,<?php // echo $row['pro_id'] ?>)" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                                    -->

                                    <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>



                                    <button type="button" name="add_cart" class="btn btn-primary add_cart" data-pro_name="<?php echo $row['pro_name'] ?>" data-price="<?php echo $row['price'] ?>" data-pro_id="<?php echo $row['pro_id'] ?>" data-pro_feature="<?php echo $row['pro_feature'] ?>" data-discount="<?php echo $row['discount']?>" /><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </p>


                            </div>

                            <div class="row" id="thumbs">

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url() ."upload/product/". $row['pro_feature'] ;?>" class="thumb">
                                            <img src="<?php echo base_url() ."upload/product/". $row['pro_feature'] ;?>" alt=""  style="width: 100%;height: 100px;">
                                        </a>
                                    </div>

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url() ."upload/product/". $row['img1'] ;?>" class="thumb">
                                            <img src="<?php echo base_url() ."upload/product/". $row['img1'] ;?>" alt=""  style="width: 100%;height: 100px;">
                                        </a>
                                    </div>

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url() ."upload/product/". $row['img2'] ;?>" class="thumb">
                                            <img src="<?php echo base_url() ."upload/product/". $row['img2'] ;?>" alt=""  style="width: 100%;height: 100px;">
                                        </a>
                                    </div>                              
                                                     
                            </div>

                        </div>

                    </div>
                </form>
<?php } ?>  
<!-- <?php //$this->load->view('includes/function_js'); ?>   -->                

 