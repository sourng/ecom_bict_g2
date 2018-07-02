
<!--End Hidden form -->
<form method="POST" action="<?php echo site_url() ;?>checkout2.html">
    <h1>Checkout</h1>
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
        </li>
        <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Delivery Method</a>
        </li>
        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>
        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
    </ul>

    <div class="content">

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" required="" >
                   
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" required="" >                   
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="company" name="company" class="form-control" id="company" required="">
                 
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="street">Street</label>
                    <input type="text" name="street" class="form-control" id="street" required="">
                   
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" name="gender" class="form-control" id="gender" required="">
                   
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="zip">ZIP</label>
                    <input type="text" name="zip" class="form-control" id="zip" required="">                  
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="state">State</label>
                    <select class="form-control" name="state" id="state" required="">
                        <option value="Siem Reap">Siem Reap</option>
                        <option value="Phnom phen">Phnom phen</option>
                        <option value="svay reng">svay reng</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" name="country" id="country">
                        <option value="Cambodia">Cambodia</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Vietname">Vietname</option>
                        <option value="Lao">Lao</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="phone">Telephone</label>
                    <input type="text" name="phone" class="form-control" id="phone" required="">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" required="">
                    
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <div class="box-footer">
        <div class="pull-left">
            <a href="<?php echo site_url() ;?>basket.html" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
        </div>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i>
            </button>
        </div>
    </div>
</form>