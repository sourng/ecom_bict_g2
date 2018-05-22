<?php foreach ($detail as $row) { ?>
<div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="<?php echo base_url($row['pro_feature']); ?>" alt="" style="width: 100%;height: 400px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="text-center"><?php echo $row['pro_name'] ?></h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                                </p>
                                <p class="price">$<?php echo $row['price'] ?></p>

                                <p class="text-center buttons">
                                    <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                                    <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                                </p>


                            </div>

                            <div class="row" id="thumbs">

                          <?php    
                          $dir = glob($row['pro_img_folder']."/*.*");

                        for ($i=0; $i<3; $i++)
                          {
                            $image_name = $dir[$i];
                            $supported_format = array('gif','jpg','jpeg','png');
                            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                            if (in_array($ext, $supported_format))
                                { ?>
                                    <div class="col-xs-4">
                                        <a href="<?php echo $image_name ;?>" class="thumb">
                                            <img src="<?php echo $image_name ;?>" alt=""  style="width: 100%;height: 100px;">
                                        </a>
                                    </div>
                                 
                              <?php  
                          } else {
                                  continue;
                                }                         
                         } ?>
                

           
                               
                                
                               
                            </div>
                        </div>

                    </div>
<?php } ?>                    