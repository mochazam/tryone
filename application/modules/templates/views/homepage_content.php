<?php
 echo anchor('youraccount/start', 'Create New Account');
 echo "<br>";
 echo anchor('youraccount/login', 'Login');
?>

<?= Modules::run('homepage_blocks/_draw_blocks') ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?= Modules::run('blog/_draw_feed_hp') ?>
		</div>
	
		<div class="col-md-4">
			<h2>Heading</h2>
			<p>lorem ipsum dolor sit amet</p>
			<p><a href="#" class="btn btn-default" role="button">view detail &raquo;</a></p>
		</div>
	</div>