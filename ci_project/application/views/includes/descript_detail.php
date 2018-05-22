 <div class="box" id="details">
                        <p>
                            <h4>Product details</h4>
                            <p>White lace top, woven, has a round neck, short sleeves, has knitted lining attached</p>
                            <h4>Material & care</h4>
                            <ul>
                                <li>Polyester</li>
                                <li>Machine wash</li>
                            </ul>
                            <h4>Size & Fit</h4>
                            <ul>
                                <li>Regular fit</li>
                                <li>The model (height 5'8" and chest 33") is wearing a size S</li>
                            </ul>

                            <blockquote>
                                <p><em>Define style this season with Armani's new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em>
                                </p>
                            </blockquote>

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
                    </div>
 
 <div class="row same-height-row">
                 <?php foreach ($product as $row) { ?>      

                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>">
                                                <img src="<?php echo base_url($row['pro_feature']); ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>">
                                                <img src="<?php echo base_url($row['pro_feature']); ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>" class="invisible">
                                    <img src="<?php echo base_url($row['pro_feature']); ?>" alt="" class="img-responsive">
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