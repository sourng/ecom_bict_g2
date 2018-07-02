
<form id="regForm" method="post" action="<?php echo site_url(); ?>front/save_check_out">
  <!-- One "tab" for each step in the form: -->
    <div class="row">
      <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
        </li>
        <li class=""><a href="#"><i class="fa fa-truck"></i><br>Delivery Method</a>
        </li>
        <li class=""><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>
        <li class=""><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
    </ul>
    <!-- tab 1 -->
      <div class="tab">
        <div class="col-md-6">
        
          <div class="form-group">
            <label for="fname">Firstname</label>
          <input placeholder="First name..." oninput="this.className = ''" name="fname">
          </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input placeholder="Last name..." oninput="this.className = ''" name="lname">
        </div>
          <div class="form-group">
            <label for="company">Company</label>
          <input placeholder="Company..." oninput="this.className = ''" name="company">
          </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input placeholder="Phone Number..." oninput="this.className = ''" name="phone">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
         <input placeholder="Email..." oninput="this.className = ''" name="email">
        </div>
      </div>
  
      <div class="col-md-6">
        <div class="form-group">
          <label for="street">Street</label>
        <input placeholder="Street..." oninput="this.className = ''" name="street">
        </div>
        <div class="form-group">
          <label for="zip">Zip</label>
        <input placeholder="Zip..." oninput="this.className = ''" name="zip">
        </div>
         <div class="form-group">
          <label for="state">State</label>
        <input placeholder="City..." oninput="this.className = ''" name="state">
        </div>
        <div class="form-group">
          <label for="country">Country</label>
         <input placeholder="Country..." oninput="this.className = ''" name="country">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
         <input type="password" placeholder="Password for Email..." oninput="this.className = ''" name="password">
        </div>
      </div>
    </div>
    </div>


<!-- tab 2 -->
  <div class="tab">
 <div class="row">
    <div class="col-sm-6">
        <div class="box payment-method">

            <h4>USPS Next Day</h4>

            <p>Get it right on next day - Bus.</p>

            <div class="box-footer text-center">

                <input type="radio" name="bus">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box payment-method">
            <h4>USPS Next Day</h4>

            <p>Get it right on next day - Flight.</p>

            <div class="box-footer text-center">

                <input type="radio" name="flight">
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="box payment-method">

            <h4>USPS Next Day</h4>

            <p>Get it right on next day - Cruise.</p>

            <div class="box-footer text-center">

                <input type="radio"  name="cruise" >
            </div>
        </div>
    </div>
</div>

    <!-- <input placeholder="E-mail..." oninput="this.className = ''" name="email">
    <input placeholder="Phone..." oninput="this.className = ''" name="phone"> -->
  </div>
  <div class="tab">
    <div class="row">
    <div class="col-sm-6">
        <div class="box payment-method">

            <h4>Paypal</h4>

            <p>We like it all.</p>

            <div class="box-footer text-center">

                <input type="radio" name="paypal">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box payment-method">

            <h4>Payment gateway</h4>

            <p>VISA and Mastercard only.</p>

            <div class="box-footer text-center">

                <input type="radio" name="mastercard">
            </div>
        </div>
    </div> 
    <div class="col-sm-6">
        <div class="box payment-method">

            <h4>Cash on delivery</h4>

            <p>You pay when you get it.</p>

            <div class="box-footer text-center">

                <input type="radio" name="cash">
            </div>
        </div>
    </div>
     <!-- <div class="col-sm-6">
        <div class="box payment-method">

            <h4>Enter Your Card Number</h4>
              <input placeholder="Enter Your Card Number" oninput="this.className = ''" name="cart_number">
              <label for="confirm">Confirm Card Number</label>
              <input placeholder="Confirm Card Number" oninput="this.className = ''" name="con_number">
              <label for="cvv">Enter CVV</label>
              <input placeholder="CVV" oninput="this.className = ''" name="cvv">
        </div>
    </div> -->
</div>
    <!-- <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
    <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
    <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p> -->
  </div>
  <!-- tab 3 -->
<div class="tab">
  <!-- <div class="col-md-9" id="basket"> -->
     <!--  <div class="box"> -->
          <!-- <form method="post" action="<?php //echo site_url();?> checkout1.html"> -->
              <p class="text-muted">You currently have <?php  echo count($this->cart->contents());  ?> item(s) in your cart.</p>
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th colspan="2">Product</th>
                              <th>Quantity</th>
                              <th>Unit price</th>
                              <!-- <th>Discount</th> -->
                              <th >Total</th>
                              <th>Remove</th>

                          </tr>
                      </thead>
                      <tbody>
          
              <div class="">
                   <?php 
                    if(isset($cart) && is_array($cart) && count($cart)){
                    $i=1;
                    foreach ($cart as $data) { 
                      // $cart as $item
                      /*print_r($cart);*/
                    ?>
                  <tr class="item first rowid<?php echo $data['rowid'] ?>">
                    <td class="thumb">
                       <img  src ="<?php echo base_url() ."upload/product/". $data['img'] ;?>" alt="<?php echo ($data['name']); ?> ">
                    </td>
                    <td  class="name"><?php echo $data['name']; ?></td>                  
                    <td class="qnt-count" width="60">
                      <input onchange="javascript:updateproduct('<?php echo $data['rowid'] ?>')" class="quantity qty<?php echo $data['rowid'] ?> form-control" type="number" min="1" value="<?php echo $data['qty'] ?>">                    
                    </td>
                  
                    <td  class="price">$ <span class="price<?php echo $data['rowid'] ?>"><?php echo $data['price'] ?></span>
                    </td>
                    <!-- <td  class="discount"><span class="discount<?php// echo $data['rowid'] ?>"><?php //echo $data['discount'] ?>%</span>
                    </td> -->
                      
                    <td style="width: 120px;" class="total">$ <span class="subtotal subtotal<?php echo $data['rowid'] ?>"><?php  echo  $data['subtotal'] ?>
                          
                      </span>
                    </td>
                    <td class="delete"><i class="icon-delete btn btn-danger" onclick="javascript:deleteproduct('<?php echo $data['rowid'] ?>')"><i class="fa fa-trash-o"></i></i></td>
                  </tr>

                  <?php
                    $i++;
                      } }
                  ?>
              </div>         
                      </tbody>
                      <tfoot>
                          <tr>
                              <th colspan="5">Total</th>
                              <th colspan="2">$<span class="grandtotal">
                              <?php
                                  $grand_total = 0;
                                  // Calculate grand total.
                                  if ($cart = $this->cart->contents()):
                                  foreach ($cart as $data):
                                  $grand_total = $grand_total + $data['subtotal'];
                                  endforeach;
                                  endif;
                                  echo $grand_total;
                                  ?> </span></th>
                                 
                              </th>
                          </tr>
                      </tfoot>
                  </table>

              </div>
              <!-- /.table-responsive -->
             <!--  <div class="box-footer">
                  <div class="pull-left">
                      <a href="<?php //echo site_url(); ?>category.html" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                  </div>
                  <div class="pull-right">
                      <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                      <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                      </button>
                  </div>
              </div> -->
          <!-- </form> -->
      <!-- </div> -->
      <!-- /.box -->
  <!-- </div> -->
 
</div>
    <!-- <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p> -->
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>


<script type="text/javascript">
function deleteproduct(rowid)
{
var answer = confirm ("Are you sure you want to delete?");
if (answer)
{
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('my_cart/remove');?>",
                data: "rowid="+rowid,
                success: function (response) {
                    $(".rowid"+rowid).remove(".rowid"+rowid); 
                    $(".cartcount").text(response);  
                    var total = 0;
                    $('.subtotal').each(function(){
                        total += parseInt($(this).text());
                        $('.grandtotal').text(total);
                    });              
                }
            });
      }
}
var total = 0;
$('.subtotal').each(function(){
    total += parseInt($(this).text());
    $('.grandtotal').text(total);
});
function updateproduct(rowid)
{

var qty = $('.qty'+rowid).val();
var price = $('.price'+rowid).text();
var subtotal = $('.subtotal'+rowid).text();
 // alert("Hello " + qty);
    $.ajax({
            type: "POST",
            url: "<?php echo site_url('my_cart/update_cart');?>",
            data: "rowid="+rowid+"&qty="+qty+"&price="+price+"&subtotal="+subtotal,
            success: function (response) {
                    $('.subtotal'+rowid).text(response);
                    var total = 0;
                    $('.subtotal').each(function(){
                        total += parseInt($(this).text());
                        $('.grandtotal').text(total);
                    });     
            }
        });
}
</script>