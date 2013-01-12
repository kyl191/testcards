<?php if (isset($posts) && is_array($posts) && count($posts)) :?>

	<?php foreach ($posts as $post) : ?>
	
    <div class="post">
		<h2><a href="/cards/start_quiz/<?php echo $post['id'];?>"><?php e($post['title']) ?></a></h2>
		
		<?php e($post['description']) ?> &mdash; by <?php echo($post['username']); ?>
	</div>
	<?php endforeach; ?>

<?php else : ?>
	<div class="alert alert-info">
		No Posts were found.
	</div>
<?php endif; ?>