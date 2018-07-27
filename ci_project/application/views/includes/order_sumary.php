
 <div class="col-md-3">
    <div class="box" id="order-summary">
        <div class="box-header">
            <h3>Order summary</h3>
        </div>
        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

        <div class="table-responsive">
            <table class="table">
                <tbody>

                    <tr>
                        <td>Order subtotal</td>
                        <?php
                            $grand_total = 0;
                            // Calculate grand total.
                            if ($cart = $this->cart->contents()):
                            foreach ($cart as $data):
                            $grand_total = $grand_total + $data['subtotal'];
                            endforeach;
                            endif;
                            //echo $grand_total;
                        ?>
                        
                        <th>$ <?php echo $grand_total; ?> </th>
                    </tr>
                    <tr>
                        <td>Delivery service</td>
                        <th>$<?php echo $grand_total; ?></th>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <th>$<?php echo $grand_total; ?></th>
                    </tr>
                    <tr class="total">
                        <td>Total</td>
                        <th>$<?php echo $grand_total; ?></th>
                         
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
