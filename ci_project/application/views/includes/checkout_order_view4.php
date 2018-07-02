<form method="post" action="<?php echo site_url(); ?>checkout4.html">

<input type="hidden" name="firstname" value="<?php echo $_POST['firstname']; ?>">
<input type="hidden" name="lastname" value="<?php echo $_POST['lastname']; ?>">
<input type="hidden" name="company" value="<?php echo $_POST['company']; ?>">
<input type="hidden" name="street" value="<?php echo $_POST['street']; ?>">
<input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
<input type="hidden" name="zip" value="<?php echo $_POST['zip']; ?>">
<input type="hidden" name="state" value="<?php echo $_POST['state']; ?>">
<input type="hidden" name="country" value="<?php echo $_POST['country']; ?>">
<input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>"> 
<input type="hidden" name="bus" value="<?php echo $_POST['bus']; ?>">
<input type="hidden" name="flight" value="<?php echo $_POST['flight']; ?>">
<input type="hidden" name="cruise" value="<?php echo $_POST['cruise']; ?>">




    
<h1>Checkout - Order review</h1>
<ul class="nav nav-pills nav-justified">
    <li><a href="checkout1.html"><i class="fa fa-map-marker"></i><br>Address</a>
    </li>
    <li><a href="checkout2.html"><i class="fa fa-truck"></i><br>Delivery Method</a>
    </li>
    <li><a href="checkout3.html"><i class="fa fa-money"></i><br>Payment Method</a>
    </li>
    <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
    </li>
</ul>

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
                  ?>

                <tr class="item first rowid<?php echo $data['rowid'] ?>">
                  <td class="thumb">
                     <img src="<?php echo base_url() ."upload/product/". $data['img'] ;?>" alt="<?php echo ($data['name']); ?>">
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
<div class="box-footer">
    <div class="pull-left">
        <a href="checkout3.html" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Payment method</a>
    </div>
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i>
        </button>
    </div>
</div>
</form>
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