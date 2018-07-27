   <div class="tab">
      <div class="row">
          <div class="col-sm-12">
            <div id="tab4" class="tab-grid" style="display: block;">
                <div class="row">
                  <div class="col-md-6">
                    <img style="width: 100%;" class="pp-img " src="<?php echo base_url() ."upload/product/paypal.png"?>" alt="Image Alternative text" title="Image Title">
                    <p>Important: You will be redirected to PayPal's website to securely complete your payment.</p>
                    <a class="btn btn-primary">Checkout via Paypal</a>
                  </div>
                  <div class="col-md-6 number-paymk">
                    <form class="cc-form">
                      <div class="clearfix">
                        <div class="controls">
                          <label class="control-label">Name on Card</label>
                          <input placeholder="Enter Card Name/VISA/Mastercard " oninput="this.className = ''" name="namecard">
                        </div>
                        <div class="form-group form-group-cc-number">
                          <label>Card Number</label>
                          <input placeholder="xxxx xxxx xxxx xxxx" oninput="this.className = ''" name="card_number">
                          <span class="cc-card-icon"></span>
                        </div>
                        <div class="form-group form-group-cc-cvc">
                          <label>CVV</label>
                          <input placeholder="xxxx" oninput="this.className = ''" name="cvv">
                        </div>
                      </div>
                      <div class="clearfix">
                        <div class="form-group form-group-cc-name">
                          <label>Card Holder Name</label>
                          <input placeholder="Enter Card Holder Name" oninput="this.className = ''" name="holdername">
                        </div>
                        <div class="form-group form-group-cc-date">
                          <label>Valid Date</label>
                          <input placeholder="mm/yy" type="date" oninput="this.className = ''" name="valid_date"> 
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>        
      </div>
  </div>