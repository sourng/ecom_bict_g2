 <div class="col-md-6">
	<div class="box">
		<h1>Login</h1>

		<p class="lead">Already our customer?</p>
		<p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies
			mi vitae est. Mauris placerat eleifend leo.</p>

		<hr>

		<!-- <form action="<?php// echo site_url(); ?>customer_orders.html" method="post">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password">
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
			</div>
		</form>     -->     

<form method="post" action="<?php echo base_url(); ?>main/login_validation">  
	<div class="form-group">  
		 <label>Enter Email</label>  
		 <input type="text" name="email" class="form-control" />  
		 <span class="text-danger"><?php echo form_error('email'); ?></span>                 
	</div>  
	<div class="form-group">  
		 <label>Enter Password</label>  
		 <input type="password" name="password" class="form-control" />  
		 <span class="text-danger"><?php echo form_error('password'); ?></span>  
	</div>  
	<div class="form-group">  
		 <input type="submit" name="insert" value="Login" class="btn btn-info" />  
		 <?php  
			  echo '<label class="text-danger">'.$this->session->flashdata

("error").'</label>';  
		 ?>  
	</div>  
</form> 
	</div>
	</div>