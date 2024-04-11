<?php if(have_posts() ): while(have_posts() ): the_post();?>

	
<div class="card mb-3">
	  <div class="card-body d-flex justify-content-center align-items-center">
	  	<?php if(has_post_thumbnail()):?>
      <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="img-fluid mb-3 img-thumbnail mr-4">
    <?php endif;?>
    <div class="blog-content">
	  	<!-- the blog title -->
	  	<h3 class="card-title"><?php the_title();?></h3>

		<!-- blog article summary -->
		<p class="card-text"><?php the_excerpt();?> </p>

		<!-- read more link to the blog article -->
		<a class="btn btn-success" href="<?php the_permalink(); ?>">Read More</a>
	</div>
</div>
</div>

<?php endwhile;else:?>

No Search Results for '<?php echo get_search_query(); ?>'

<?php  endif;?>