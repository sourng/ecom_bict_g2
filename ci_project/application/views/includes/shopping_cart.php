
<div class="col-md-9" id="basket">
    <div class="box">
        <form method="post" action="<?php echo site_url();?> checkout1.html">
            <h1>Shopping cart</h1>
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
                    <a href="<?php echo site_url(); ?>category.html" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                </div>
                <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                     <a href="<?php echo site_url(); ?>checkout1.html" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                                   
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->
</div>
 <?php $this->load->view('includes/order_sumary.php'); ?>

<!-- <?php //$this->load->view('includes/function_js'); ?> -->

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