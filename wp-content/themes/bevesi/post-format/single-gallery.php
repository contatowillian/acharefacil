<article class="post post-single">
	<div class="post-header">
		<div class="entry-meta">
		  <a href="<?php the_permalink(); ?>"><span class="meta-item meta-date"><?php echo get_the_date(); ?></span></a>
		</div><!-- entry-meta -->
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php if(has_category()){ ?>
				<span class="meta-item post-category">
					<?php the_category(', '); ?>
				</span><!-- entry-category -->
			<?php } ?>
			
			<?php the_tags( '<span class="meta-item entry-tags">', ', ', ' </span>'); ?>

			<?php if ( is_sticky()) {
				printf( '<span class="meta-item sticky-post">%s</span>', esc_html__('Featured', 'bevesi' ) );
			} ?>
		</div><!-- entry-meta -->
	</div><!-- post-header -->
	<div class="post-thumbnail">
		<figure class="entry-media">
			<?php $images = rwmb_meta( 'klb_blogitemslides', 'type=image_advanced&size=medium' ); ?>
			<?php if($images) { ?>
				
				<div class="blog-gallery">
					<?php  foreach ( $images as $image ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo esc_url($image['full_url']); ?>" alt="<?php the_title_attribute(); ?>">
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</figure>
	</div><!-- post-thumbnail -->
	<div class="post-content">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'bevesi' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
		</div><!-- entry-content -->
	</div><!-- post-content -->
</article><!-- post -->
