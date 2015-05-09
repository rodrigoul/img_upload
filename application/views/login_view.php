<?php include('header.php'); ?>
  
<div class="box-shadow" style="margin: 18px auto;width:400px;">	
	<!-- HEADER -->
	<div id="header">
		<div class="page-full-width cf">
			<div id="login-intro" class="fl">
				<h1>WEB FTP.</h1> Insert your ftp username and Password.
			</div> 
		</div>
	</div>	
	<h3> <?php echo (isset($msg)? $msg : '');?></h3>
	<!-- MAIN CONTENT -->
	<div id="content">
	
		<form name='login-form' action="<?php echo BASE_URL; ?>index.php/login/login_user" method="POST" style="width:390px;;">
			<fieldset style="display: block;">
					<label for="login">Username</label>
					<div class="input-group">
					  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					  <input type="text" name="username" id="username" placeholder="Email" class="round full-width-input form-control" autofocus style="height: 30px;"/>
					</div>
					<label for="login-password">Password</label>
					<div class="input-group">
					  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					  <input type="password" name="password" id="password" placeholder="password" class="round full-width-input form-control" style="height: 30px;"/>
					</div>
				<p>
				  <input type="submit" class="btn btn-success pull-right" value="Submit" />
				</p>                
			</fieldset>
            

		</form>
		
	</div> <!-- end content -->	
</div> <!-- end content -->	
<?php include('footer.php'); ?>