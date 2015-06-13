<html>
	<head>
		<title>
			<?php echo $title; ?>
		</title>
	</head>
	<body>
		<h1> <?php echo $header; ?> </h1>
			<?php if(isset($error)): ?>
				<div class="error">
					<p><?php echo $error; ?>
				</div>
			<?php endif; ?>
			<?php echo validation_errors(); ?>
		<?php 
			echo form_open("login/verifyLogin");
			echo form_label("Username: ", 'username');
			echo form_input('username', 'John Doe');
			echo form_label("Password: ", 'password');
			echo form_password('password', 'password');
			echo form_submit('submit', 'submit');
			echo form_close();
		?>
	</body>
</html>