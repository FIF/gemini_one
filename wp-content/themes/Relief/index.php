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
		
		<!-- BEGIN .blog-list-wrapper -->
		<div class="blog-list-wrapper section clearfix">
			
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				<?php load_template( TEMPLATEPATH . '/includes/loop.php' ); ?>
			</div>
			
			<?php get_sidebar(); ?>
		
		<!-- END .blog-list-wrapper -->		
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>