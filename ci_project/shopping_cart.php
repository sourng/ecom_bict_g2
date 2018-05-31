<div class="col-md-9" id="basket">
    <div class="box">
        <form method="post" action="checkout1.html">
            <h1>Shopping cart</h1>
            <p class="text-muted">You currently have 3 item(s) in your cart.</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2">Product</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Discount</th>
                            <th colspan="2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shopping as $row) { ?>
                        <tr>
                            <td>
                                <a href="#">
                                                    <img src="<?php echo base_url($row['pro_feature']); ?>" alt="White Blouse Armani">
                                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <?php echo ($row['pro_name']); ?>
                                </a>
                            </td>
                            <td>
                                <div class="">
                                    <a onclick="decrement_quantity(<?php echo $row['lastorder']?>,<?php echo $row['pro_id'] ?>)" class="btn btn-sm btn-default">-</a>

                                    <input style="height:28px;" id='input-quantity-<?php echo $row['pro_id'] ?>' type="text" value="<?php echo $row['countpro'] ?>">
                                    <a onclick="increment_quantity(<?php echo $row['lastorder']?>,<?php echo $row['pro_id'] ?>)" class="btn btn-sm btn-default">+</a>
                                </div>
                            </td>
                            <td>$
                                <?php echo ($row['price']); ?>
                            </td>
                            <td>$0.00</td>
                            <td>$
                                <?php echo $row['sumprice'] ?>
                            </td>
                            <td><a href="#"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total</th>
                            <th colspan="2">
                                <?php foreach ($total as $row) {
                                            echo '$'.$row['total'];
                                           } ?>
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
                    <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->
    <div class="row same-height-row">
        <div class="col-md-3 col-sm-6">
            <div class="box same-height">
                <h3>You may also like these products</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="product same-height">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product2.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                        <div class="back">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product2_2.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                    </div>
                </div>
                <a href="detail.html" class="invisible">
                                    <img src="<?php echo base_url('template') ?>/img/product2.jpg" alt="" class="img-responsive">
                                </a>
                <div class="text">
                    <h3>Fur coat</h3>
                    <p class="price">$143</p>
                </div>
            </div>
            <!-- /.product -->
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="product same-height">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product1.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                        <div class="back">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product1_2.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                    </div>
                </div>
                <a href="detail.html" class="invisible">
                                    <img src="<?php echo base_url('template') ?>/img/product1.jpg" alt="" class="img-responsive">
                                </a>
                <div class="text">
                    <h3>Fur coat</h3>
                    <p class="price">$143</p>
                </div>
            </div>
            <!-- /.product -->
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="product same-height">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product3.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                        <div class="back">
                            <a href="detail.html">
                                                <img src="<?php echo base_url('template') ?>/img/product3_2.jpg" alt="" class="img-responsive">
                                            </a>
                        </div>
                    </div>
                </div>
                <a href="detail.html" class="invisible">
                                    <img src="<?php echo base_url('template') ?>/img/product3.jpg" alt="" class="img-responsive">
                                </a>
                <div class="text">
                    <h3>Fur coat</h3>
                    <p class="price">$143</p>
                </div>
            </div>
            <!-- /.product -->
        </div>
    </div>
</div>

<script type="text/javascript">
function increment_quantity(order_id,pro_id) {
    var inputQuantityElement = $("#input-quantity-" + order_id);
    var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
    $(inputQuantityElement).val(newQuantity);

    save_to_db(order_id, pro_id,'add');


}

function decrement_quantity(order_id,pro_id) {
    var inputQuantityElement = $("#input-quantity-" + order_id);
    if ($(inputQuantityElement).val() > 1) {
        var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
        $(inputQuantityElement).val(newQuantity);

        save_to_db(order_id, pro_id ,'delete');

    }
}

function save_to_db(order_id, pro_id, active) {
        $.ajax({ 
            type:"GET",
            url: "<?php echo site_url('update/add_order') ?>",         
           data: "order_id=" + order_id + "&pro_id=" + pro_id+"&active=" + active,
            cache: false,
            success:function(data){
            $("#basket").load('shopping_cart.php');

            }
          })
        }; 
</script>