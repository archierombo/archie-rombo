
    <?php get_header();?>


    <?php if ( is_active_sidebar( 'page-sidebar' ) && is_active_sidebar('blog-sidebar') ) : ?>
    	<div class="container-fluid" style="padding-left: 2rem;padding-right: 2rem;"><!--container-->
    	<div class="row"> <!--row-->
	<div class="col-sm-2" id="sidebar">
		<?php dynamic_sidebar('page-sidebar'); ?>
	</div>
	<div class="col-sm-8">
		<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','article');
				}
			}
			?>
	</div>
	<div class="col-sm-2">
			<?php dynamic_sidebar('blog-sidebar'); ?>
	</div>
</div><!--row-->
</div><!--container-->
<?php elseif(is_active_sidebar( 'page-sidebar' )): ?>

	<div class="container-fluid" style="padding-left: 2rem;padding-right: 2rem;"><!--container-->
    	<div class="row"> <!--row-->
	<div class="col-sm-3" id="sidebar">
		<?php dynamic_sidebar('page-sidebar'); ?>
	</div>
	<div class="col-sm-9">
		<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','article');
				}
			}
			?>
	</div>
	
</div><!--row-->
</div><!--container-->
<?php elseif(is_active_sidebar( 'blog-sidebar' )): ?>
	<div class="container-fluid" style="padding-left: 2rem;padding-right: 2rem;"><!--container-->
    	<div class="row"> <!--row-->
	<div class="col-sm-1" >
		
	</div>
	<div class="col-sm-8">
		<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','article');
				}
			}
			?>
	</div>
	<div class="col-sm-3" id="sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
	</div>
</div><!--row-->
</div><!--container-->
<?php else: ?>

	<article class="content px-3 py-5 p-md-5" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','article');
				}
			}
			?>
			
	    
	    </article>

<?php endif; ?>


 <?php get_footer();?>





 