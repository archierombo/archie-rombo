




 <?php if ( is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4') ) : ?>
<div class="container-fluid bg-light-subtle" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
	</div>
</div>

<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-3')): ?>


<div class="container-fluid " style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-4 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
	</div>
</div>

<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		
		
	</div>
</div>


<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-3')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-3')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid " style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-sm-6"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-sm-6"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-3' ) && is_active_sidebar('footer-widget-4')): ?>


<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) ): ?>


<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) ): ?>


<div class="container ">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-3' ) ): ?>


<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-4' ) ): ?>


<div class="container ">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
		
	</div>
</div>
<?php endif; ?>


	<footer class="footer mt-auto py-3 bg-body-tertiary" >
		<div class="row">
			<div class="col-md-8 d-flex align-items-center">
			
			<span class="mb-3 mb-md-0"><i class="fa fa-copyright"></i>&nbsp;2014 - <?php echo date('Y');  ?></span> 
			<a class="mb-3 me-2 mb-md-0  text-decoration-none lh-1" href="<?php echo get_home_url('/'); ?>">&nbsp;Archie Rombo</a>&nbsp;| &nbsp;
			<p class="float-end">
			<?php
		// translators: Theme Name and Link to ArchieRombo.
		printf(
			esc_html__( 'WordPress Theme: %1$s by %2$s.', 'archie-rombo' ),
			esc_html__( 'archie-rombo', 'archie-rombo' ),'Archie Rombo'
		);
		?>
			</p>
		</div>
		</div>
		
		
	</footer>

<?php wp_footer();?>

</body>
</html>