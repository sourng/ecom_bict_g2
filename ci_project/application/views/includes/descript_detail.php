 <div class="box" id="details">
    
    <?php foreach ($product_detail as $row) { ?>        
            <p>
                <?php echo ($row['pro_detail']); ?>
            </p>

        <hr>
        <div class="social">
            <h4>Show it to your friends</h4>
            <p>
                <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
            </p>
        </div>
    <?php } ?>
        
</div>
 
 <div class="row same-height-row">
                 <?php foreach ($product_lastes as $row) { ?>      

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>">
                                                <img src="<?php echo base_url('upload/product/'.$row['pro_feature']); ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>">
                                                <img src="<?php echo base_url('upload/product/'.$row['pro_feature']); ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>" class="invisible">
                                    <img src="<?php echo base_url('upload/product/'.$row['pro_feature']); ?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><?php echo $row['pro_name'] ?></h3>
                                    <p class="price">$<?php echo $row['price'] ?></p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
<?php } ?>
                    </div>