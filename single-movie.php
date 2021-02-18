<?php 

/*
Template Name: Movie Layout
Template Post Type: movie
*/

get_header();

while(have_posts()) {
	the_post();
	//creates divs to display the post metas, the featured image, and the content(full description)
	?>  
	<div class='movieInfo'>
		<h1><?php the_title() ?></h1>
		<h2>Release Date: <?php echo get_post_meta($post->ID, 'releaseDate', true) ?> </h2> 
		<h2>Director: <?php echo get_post_meta($post->ID, 'director', true) ?></h2>
		<h2>Genre: <?php echo get_post_meta($post->ID, 'genre', true) ?></h2>
	</div>
	<div class="movieImgWrap"> 
		<?php
		//If the post has a thumbnail set, display that. Otherwise use a placeholder image.
		if(has_post_thumbnail()) {
			the_post_thumbnail('full');
		} else {
			?> <img class='movieImg' src="https://i.stack.imgur.com/y9DpT.jpg" alt="placeholder"> <?php
		}	?>
	</div>
	<div class='movieDesc'> 
		<p> 
			<?php the_content(); ?>
		</p>
	</div>
	
<?php
}
?>