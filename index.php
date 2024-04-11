
    <?php get_header();?>
    
		<article class="content px-3 py-5 p-md-5">
			<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','archive');
				}
			} ?>


<br>
<?php
			//adding pagination
			the_posts_pagination(
				array(
				 'mid_size'  => 2,
				 'prev_text' => __( '<<', 'archie-rombo' ),
				 'next_text' => __( '>>', 'archie-rombo' ),
				)
			);
			?>
	    
	    </article>
	    
 <?php get_footer();?>