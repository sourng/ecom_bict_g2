<style type="text/css">
/*****************globals*************/
body {
  font-family: 'open sans';
  overflow-x: hidden; }

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */
/* Relate Products Code */
	    h4{
    	font-weight: 600;
	}
	p{
		font-size: 12px;
		margin-top: 5px;
	}
	.price{
		font-size: 30px;
    	margin: 0 auto;
    	color: #333;
	}
	.right{
		float:right;
		border-bottom: 2px solid #4B8E4B;
	}
	.thumbnail{
		opacity:0.70;
		-webkit-transition: all 0.5s; 
		transition: all 0.5s;
	}
	.thumbnail:hover{
		opacity:1.00;
		box-shadow: 0px 0px 10px #4bc6ff;
	}
	.line{
		margin-bottom: 5px;
	}
	@media screen and (max-width: 770px) {
		.right{
			float:left;
			width: 100%;
		}
	}
/* Relate Products Code */
</style>
<div class="container-fluid" style="margin-top: -100px">
<div class="card">
<div class="container">
<div class="wrapper row">
	<div class="preview col-md-6">
		
		<div class="preview-pic tab-content">
		  <div class="tab-pane active" id="pic-1"><img src="image/gents.jpg" /></div>
		  <div class="tab-pane" id="pic-2"><img src="image/kvg8-ansh-fashion-wear-men.jpg" /></div>
		  <div class="tab-pane" id="pic-3"><img src="image/ladies-night-wear.jpg" /></div>
		  <div class="tab-pane" id="pic-4"><img src="image/ladies-western-wear.jpg" /></div>
		  <div class="tab-pane" id="pic-5"><img src="image/Free-shipping-springtime.jpg" /></div>
		</div>
<ul class="preview-thumbnail nav nav-tabs">
  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="image/gents.jpg" /></a></li>
  <li><a data-target="#pic-2" data-toggle="tab"><img src="image/kvg8-ansh-fashion-wear-men.jpg" /></a></li>
  <li><a data-target="#pic-3" data-toggle="tab"><img src="image/ladies-night-wear.jpg" /></a></li>
  <li><a data-target="#pic-4" data-toggle="tab"><img src="image/ladies-western-wear.jpg" /></a></li>
  <li><a data-target="#pic-5" data-toggle="tab"><img src="image/Free-shipping-springtime.jpg" /></a></li>
</ul>
		
	</div>
	<div class="details col-md-6">
		<h3 class="product-title">men's shoes fashion</h3>
		<div class="rating">
			<div class="stars">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star"></span>
				<span class="fa fa-star"></span>
			</div>
			<span class="review-no">41 reviews</span>
		</div>
		<p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
		<h4 class="price">current price: <span>$180</span></h4>
		<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
		<h5 class="sizes">sizes:
			<span class="size" data-toggle="tooltip" title="small">s</span>
			<span class="size" data-toggle="tooltip" title="medium">m</span>
			<span class="size" data-toggle="tooltip" title="large">l</span>
			<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
		</h5>
		<h5 class="colors">colors:
			<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
			<span class="color green"></span>
			<span class="color blue"></span>
		</h5>
		<div class="action">
			<button class="add-to-cart btn btn-default" type="button">add to cart</button>
			<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
		</div>
	</div>
</div>

			</div>
		</div>
<br>
<?php 
        $sql="SELECT * from tbl_product";

        $records_per_page=4;
        $newquery = $objCrud->paging($sql,$records_per_page);
        $objCrud->pro_detail($newquery);
         // $crud->getBlog($sql);
  ?>
	</div>



    
