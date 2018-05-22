 <div class="container">
                    <div class="product-slider">
                        <?php foreach ($product as $row) { ?>
                           <div class="item">
                            <div class="product">
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
                                    <h3><a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>"><?php echo ($row['pro_name']); ?></a></h3>
                                    <p class="price">$<?php echo ($row['price']); ?></p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php } ?>
                        


                    </div>
                    <!-- /.product-slider -->
                </div>