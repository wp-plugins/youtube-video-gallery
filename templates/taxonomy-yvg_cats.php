<?php get_header(); ?>
<?php echo get_option('yvg-opening-tags'); ?>
<div class="youtube-video-gallery cats">
	<div <?php post_class(); ?>>
		<?php $term = $wp_query->queried_object; ?>
		<div class="header">
			<h1 class="entry-title"><?php echo $term->name;?></h1>
			<p><?php echo $term->description;?></p>
		</div>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="inner">
			<?php $yvg_link = get_post_meta(get_the_ID(), 'yvg_link', true); ?>
			<?php $yvg_desc = get_post_meta(get_the_ID(), 'yvg_desc', true); ?>
			<div class="left">
				<img src="http://img.youtube.com/vi/<?php echo $yvg_link; ?>/hqdefault.jpg" />
			</div>
			<div class="right">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<ul>
					<li><?php _e( 'On ' ); ?><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?><?php _e( ' by ' ); ?><?php the_author_posts_link(); ?></li>
				</ul>
				<p><?php echo wp_trim_words( $yvg_desc, 10, '' ); ?></p>
			</div>
			<div class="clear"></div>
			<div class="yvg_spacer"></div>
		</div>
		<?php endwhile; ?>
		<?php next_posts_link(); ?>
		<?php previous_posts_link(); ?>
		<?php else: ?>
			<article>
				<h1><?php _e( 'Sorry, nothing to display.' ); ?></h1>
			</article>
		<?php endif; ?>
	</div>
</div>
<?php echo get_option('yvg-closing-tags'); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>