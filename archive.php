
    <?php get_header();?>
    <?php  add_theme_support( "title-tag" ); ?>
		<article class=" px-3 py-5 p-md-4">
			<?php
		if(have_posts()){
				while(have_posts()){
					
					the_post();
					get_template_part('template-parts/content','archive');



				}
			}
			?>

	    
	    </article>
	    
 <?php get_footer();?>