 <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <form action="<?php echo site_url(); ?>customer_orders.html" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
                    </div>
                </div>
