<!-- views/user_listing.php -->
<html>
   <?php   $this->load->view('includes/header'); ?>
     
    <body>
        <div class="container">
            <h1 id='form_head'>Pagination Listing</h1>
 
            <?php if (isset($results)) { ?>
                <table border="1" cellpadding="0" cellspacing="0">
 
                     <tr>           
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Image</th>
                    </tr>
                     
                    <?php foreach ($results as $data) { ?>
            <div class="col-md-4 col-sm-6">  
                <div class="product">   
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a href="#">
                                <img src="<?php echo base_url('upload/product/'.$data->img1) ?>" alt="" class="img-responsive">
                                </a>
                            </div>
                          
                        </div>
                    </div>
                   
                                <div class="text">
                                    <h3><a href="<?php echo site_url('detail.html?pro_id='.$data->pro_id) ?>"><?php echo ($data->pro_name); ?></a></h3>
                                    <p class="price">$<?php echo ($data->price); ?></p>
                                    <p class="buttons">
                                        <a href="<?php echo site_url('detail.html?pro_id='.$data->pro_id) ?>" class="btn btn-default">View detail</a>
                                        

                                       <button type="button" name="add_cart" class="btn btn-primary add_cart" data-pro_name="<?php echo $data->pro_name ?>" data-price="<?php echo $data->price ?>" data-pro_id="<?php echo $data->pro_id ?>" data-pro_feature="<?php echo $data->img1 ?>" data-discount="<?php echo $data->discount ?>" /><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    
                                    </p>
                                </div>
                </div>
            </div>
                         <tr>
                            <td><?php echo $data->pro_id ?></td>
                            <td><?php echo $data->pro_name ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <div>No Pagination(s) found.</div>
            <?php } ?>
 
            <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
        </div>
    </body>
</html>