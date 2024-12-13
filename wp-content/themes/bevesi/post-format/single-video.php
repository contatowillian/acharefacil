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
		<figure class="entry-media embed-responsive embed-responsive-16by9">
			<?php  
			if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'vimeo') {  
			  echo '<iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" height="443" allowFullScreen></iframe>';  
			}  
			else if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'youtube') {  
			  echo '<iframe height="450" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" allowfullscreen></iframe>';  
			}  
			else {  
				echo ' '.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).' '; 
			}  
			?>
		</figure>
	</div><!-- post-thumbnail -->
	<div class="post-content">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'bevesi' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
		</div><!-- entry-content -->
	</div><!-- post-content -->
</article><!-- post -->