<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN #content -->
	<div id="content">
		
		<?php // Display Breadcrumbs
			echo display_breadcrumbs(); 
		?>
		
		<!-- BEGIN .section -->
		<div class="blog-list-wrapper section clearfix">
				
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				<?php if ( post_password_required() ) {
					echo qns_password_form();
				} else { ?>
					<?php load_template( TEMPLATEPATH . '/includes/loop.php' ); ?>
				<?php } ?>
			</div>
			
			<?php get_sidebar(); ?>
		
		<!-- END .section -->			
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>