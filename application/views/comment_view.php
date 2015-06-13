<html>
	<head>
		<title>
			<?php echo $title; ?>
		</title>
	</head>
	<body>
		<h1> <?php echo $header; ?> </h1>
		<p>
			<?php echo anchor('blog/index', 'Home', array('title' => 'Go Home!'));?> > Comments
		</p>
		<div>
			<?php echo $entry->body; ?>
		</div>
		<?php foreach($comments as $row): ?>
			<div>
				<h2>
					<?php echo $row->author; ?> | <?php echo $row->posted_at; ?>
				</h2>
				<div>
					<?php echo $row->message; ?>
				</div>
			</div>
		<?php endforeach; ?>
		<?php 
			echo form_open("blog/postComment");
			echo form_hidden("entry_id", $this->uri->segment(3));
			echo form_label("What you wanna say?", 'message');
			echo form_textarea('message');
			echo form_label("Who might you be?", 'author');
			echo form_input('author', 'John Doe');
			echo form_submit('submit', 'submit');
			echo form_close();
		?>
	</body>
</html>