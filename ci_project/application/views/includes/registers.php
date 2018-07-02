 <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <form action="<?php echo site_url(); ?>customer_orders.html" method="post">
                            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname">
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" id="street">
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="phone">Telephone</label>
                        <input type="text" class="form-control" id="phone">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state"></select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control" id="country"></select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="Password" class="form-control" id="Password">
                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Register</button>

                </div>
            </div>
            </form>
        </div>
    </div>
