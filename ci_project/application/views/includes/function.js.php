
<script type="text/javascript">

    function increment_quantity(lastcart_id,pro_id) {
    var inputQuantityElement = $("#input-quantity-" + lastcart_id);
    var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
    $(inputQuantityElement).val(newQuantity);
   // save_to_db(lastcart_id, pro_id,'add');


}

function decrement_quantity(lastcart_id,pro_id) {
    var inputQuantityElement = $("#input-quantity-" + lastcart_id);
    if ($(inputQuantityElement).val() > 1) {
        var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
        $(inputQuantityElement).val(newQuantity);
        
       // save_to_db(lastcart_id, pro_id ,'delete');
       
    }
}

function save_to_db(lastcart_id, pro_id, active) {
       if (active=='add') {
         $.ajax({ 
            type:"GET",
            url: "<?php echo site_url('update/add_cart') ?>",         
           data: "pro_id=" + pro_id,
            cache: false,
            success:function(data){
            //$("#basket").load('shopping_cart.php');
            //window.location="<?php echo site_url('basket.html') ?>";
            }
          })
        }else if(active=='delete'){
         $.ajax({ 
            type:"GET",
            url: "<?php echo site_url('update/update_cart') ?>",         
            data: "cart_id=" + lastcart_id,
            cache: false,
            success:function(data){
            //$("#basket").load('shopping_cart.php');
            //window.location="<?php echo site_url('basket.html') ?>";
            }
          })
        }
    }
    function delete_order(pro_id) {
      var msg=confirm("Are you sure?");
      if (msg=true) {
           $.ajax({ 
            type:"GET",
            url: "<?php echo site_url('update/delete_cart') ?>",         
           data: "pro_id=" + pro_id,
            cache: false,
            success:function(data){
            //$("#basket").load('shopping_cart.php');
            //window.location="<?php echo site_url('basket.html') ?>";
            }
          })
      }
    }
</script>