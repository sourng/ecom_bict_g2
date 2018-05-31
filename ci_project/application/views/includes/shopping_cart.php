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
                        <?php foreach ($cart as $row) { @$sumprice+=$row['sumprice']; 
 ?>

                        <tr>
                            <td>
                                <a href="#">
                                 <img src="<?php echo base_url($row['pro_feature']); ?>" alt="<?php echo ($row['pro_name']); ?>">
                                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <?php echo ($row['pro_name']); ?>
                                </a>
                            </td>
                            <td>
                                <div class="">
                                    <a onclick="decrement_quantity(<?php echo $row['lastcartid']?>,<?php echo $row['pro_id'] ?>)" class="btn btn-sm btn-default">-</a>

                                    <input style="height:28px;" id='input-quantity-<?php echo $row['lastcartid'] ?>' type="text" value="<?php echo $row['countpro'] ?>" disabled>
                                    <a onclick="increment_quantity(<?php echo $row['lastcartid']?>,<?php echo $row['pro_id'] ?>)" class="btn btn-sm btn-default">+</a>
                                </div>
                            </td>
                            <td>$
                                <?php echo number_format($row['price'],2); ?>
                            </td>
                            <td>$0.00</td>
                            <td>$
                                <?php echo number_format($row['sumprice'],2) ?>
                            </td>
                            <td><a  onclick="delete_cart(<?php echo $row['lastcartid']?>,<?php echo $row['pro_id'] ?>)"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total</th>
                            <th colspan="2">

                                <?php foreach ($total as $row) {

                                            echo '$'.number_format($row['total'],2);
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
</div>
 <?php $this->load->view('includes/order_sumary.php'); ?>

<?php $this->load->view('includes/function_js'); ?>
