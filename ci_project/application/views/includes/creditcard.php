    <div class="tab">
      <div class="row">
        <form action="#" method="post" class="creditly-card-form agileinfo_form">
            <div class="credit-card-wrapper">
              <div class="col-md-6" >
                <h1>Credit Card</h1>
                <img style="width: 30%;" class="pp-img " src="<?php echo base_url() ."upload/product/pay1.png"?>" alt="" title="Image Title">
                <img style="width: 30%;" class="pp-img " src="<?php echo base_url() ."upload/product/pay2.png"?>" alt="" title="Image Title">
                <img style="width: 30%;" class="pp-img " src="<?php echo base_url() ."upload/product/pay3.png"?>" alt="" title="Image Title">
                <img style="width: 30%;" class="pp-img " src="<?php echo base_url() ."upload/product/pay4.png"?>" alt="" title="Image Title">
                <img style="width: 30%;" class="pp-img " src="<?php echo base_url() ."upload/product/pay5.png"?>" alt="" title="Image Title">
              </div>
              <div class="col-md-6" >
              <div class="first-row form-group">
                <div class="controls">
                  <label class="control-label">Name on Card</label>
                  <input placeholder="Enter Card Name/VISA/Mastercard " oninput="this.className = ''" name="namecard">
                </div>
                <div class="w3_agileits_card_number_grids">
                  <div class="w3_agileits_card_number_grid_left">
                    <div class="controls">
                      <label class="control-label">Card Number</label>
                      <input placeholder="xxxx xxxx xxxx xxxx" oninput="this.className = ''" name="card_number">
                      
                      <!-- <input class="number credit-card-number form-control" type="text" name="number" inputmode="numeric" autocomplete="cc-number"
                          autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;"> -->
                    </div>
                  </div>
                  <div class="w3_agileits_card_number_grid_right">
                    <div class="controls">
                      <label class="control-label">CVV</label>
                      <input placeholder="xxxx" oninput="this.className = ''" name="cvv">
                    </div>
                  </div>

                  <div class="clear"> </div>
                </div>
                <div class="form-group form-group-cc-name">
                  <label>Card Holder Name</label>
                  <input placeholder="Enter Card Holder Name" oninput="this.className = ''" name="holdername">
                </div>
                <div class="controls">
                  <label class="control-label">Expiration Date</label>
                  <input placeholder="mm/yy" type="date" oninput="this.className = ''" name="valid_date">
                </div>
              </div>
            
            </div>
          </div>
        </form>        
      </div>
  </div>