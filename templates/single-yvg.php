<?php get_header(); ?>
<?php echo get_option('yvg-opening-tags'); ?>
<div class="youtube-video-gallery video">
	<div <?php post_class(); ?>>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="inner">
			<?php $yvg_link = get_post_meta(get_the_ID(), 'yvg_link', true); ?>
			<?php $yvg_desc = get_post_meta(get_the_ID(), 'yvg_desc', true); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<iframe width='640' height='360' src='//www.youtube-nocookie.com/embed/<?php echo $yvg_link; ?>' frameborder='0' allowfullscreen></iframe>
			<p><?php echo $yvg_desc; ?></p>
			<ul>
				<li><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></li>
				<li><?php _e( 'Published by' ); ?> <?php the_author_posts_link(); ?></li>
				<li><?php comments_popup_link( __( 'Leave your thoughts' ), __( '1 Comment' ), __( '% Comments' )); ?></li>
				<li><?php _e( 'Categorised in: ' ); echo get_the_term_list( $post->ID, 'yvg_cats', '', ', ', '', '' ); ?></li>
				<?php edit_post_link('', '<li>', '</li>'); ?>
			</ul>
		</div>
	</div>
</div>				
<?php comments_template(); ?>
<?php endwhile; ?>
<?php else: ?>
	<article>
		<h1><?php _e( 'Sorry, nothing to display.' ); ?></h1>
	</article>
<?php endif; ?>
<?php echo get_option('yvg-closing-tags'); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>