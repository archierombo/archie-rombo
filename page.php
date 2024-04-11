
    <?php get_header();?>
    
		<article class=" px-3 py-5 p-md-5">
			<h1>Blog Artcicle</h1>
			<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','page');
					
				}
			}
			?>
	    
	    </article>
	    
 <?php get_footer();?>