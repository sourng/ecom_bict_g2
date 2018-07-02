<?php foreach ($lastcartid as $row) {
    $lastcartid=$row['lastcartid'];
} ?>
<div class="col-md-9">
                    <div class="box">
                        <h1><?php foreach ($category_name as $row) {
                            echo $row['cat_name'];
                        } ?></h1>
                        <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
                    </div>

                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row products">
        <?php foreach ($product as $row) { ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="product">
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
                                    <h3><a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>"><?php echo ($row['pro_name']); ?></a></h3>
                                    <p class="price">$<?php echo ($row['price']); ?></p>
                                    <p class="buttons">
                                        <a href="<?php echo site_url('detail.html?pro_id='.$row['pro_id']) ?>" class="btn btn-default">View detail</a>
                                        

                                       <button type="button" name="add_cart" class="btn btn-primary add_cart" data-pro_name="<?php echo $row['pro_name'] ?>" data-price="<?php echo $row['price'] ?>" data-pro_id="<?php echo $row['pro_id'] ?>" data-pro_feature="<?php echo $row['pro_feature'] ?>" /><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
        <?php } ?>
                    </div>
                    <!-- /.products -->

                    <div class="pages">

                        <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a>
                        </p>

                        <ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>


                </div>
<?php $this->load->view('includes/function_js'); ?>
