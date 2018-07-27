<div class="container">
	<div class="col-md-12">
		<div id="main-slider">
		   <?php
			foreach ($imageslide as $row) {
		   ?>
			<div class="item">
				<img src="<?php echo base_url(); ?>template/img/<?php echo $row['image'] ?>" alt="" class="img-responsive">
			</div>
			<?php
				}
			?>
		</div>
		<!-- /#main-slider -->
	</div>
</div>