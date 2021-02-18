<?php 
get_header();

//get posts of the type movie sorted by post date.
$postArgs = array(
    'orderby'        => 'post_date',
    'post_type'      => 'movie'
);

$moviePosts = new WP_Query($postArgs);

if ($moviePosts-> have_posts()) {
	?> <div class='postList'> <?php

	while($moviePosts -> have_posts()) {
		$moviePosts -> the_post();
		?> 
		<div class='post'>

			<div class='postText'>
				<a href= <?php the_permalink() ?>><h1> <?php the_title() ?> </h1></a>
				<h2>Genre: <?php echo get_post_meta($post->ID, 'genre', true) ?></h2>
				<h2>Release Date: <?php echo get_post_meta($post->ID, 'releaseDate', true) ?></h2>
				<p><?php echo get_post_meta($post->ID, 'shortDesc', true) ?></P>
				<a href=<?php the_permalink() ?>><button type="button" class="postButton">Read More...</button></a>
			</div>

			<div class="postImgWrap">
			<?php 	
			if(has_post_thumbnail()) {
				the_post_thumbnail('full');
			} else {
			?> <img class='postImg' src="https://i.stack.imgur.com/y9DpT.jpg" alt="placeholder"> <?php
			}
			?>
			</div>

		</div>
		<br>
		<br>
		<?php
	}

	?> </div> <?php
}
?>