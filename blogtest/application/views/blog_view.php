<html>
	<head>
		<title>
			<?php echo $title; ?>
		</title>
	</head>
	<body>
		<h1> <?php echo "Hi there " . $username . "!"; ?> </h1>
		<p> <?php echo anchor('login/logout', 'Log out', array('title' => 'Get out!'));?> </p>
		<h1> <?php echo $header; ?> </h1>
		<?php foreach($query->result() as $row): ?>
			<div>
				<div>
					<h2><?php echo $row->title; ?></h2>
				</div>
				<div>
					<?php echo $row->body; ?>
					<p>
						<?php echo anchor('blog/getAllComments/'.$row->id, 'Comments', array('title' => 'Go Comment!'));?>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
	</body>
</html>