<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">

                                <?php foreach ($category as $row) { ?>

                                <li>
                                    <a href="<?php echo site_url('category.html/'.$row['cat_id'].'/1'); ?>"><?php echo $row['cat_name'] ?></a>
                                   
                                </li>
                                <?php } ?>
                                <!-- <li>
                                    <a href="category.html">Kids  <span class="badge pull-right">11</span></a>
                                    <ul>
                                        <li><a href="category.html">T-shirts</a>
                                        </li>
                                        <li><a href="category.html">Skirts</a>
                                        </li>
                                        <li><a href="category.html">Pants</a>
                                        </li>
                                        <li><a href="category.html">Accessories</a>
                                        </li>
                                    </ul>
                                </li> -->

                            </ul>

                        </div>
                    </div>