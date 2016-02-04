<?php get_header(); ?>
	<div class="col-sm-9">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class('clearfix article-post') ?> id="post-<?php the_ID(); ?>">
			<header class="article-header">
				<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="article-meta"><?php the_time('F jS, Y') ?> by <?php the_author(); ?></div>
			</header>
			<div class="article-content">
				<?php 
					the_content(); 
					edit_post_link('edit', '<p>', '</p>');
				?>
			</div>
		</article>
		<?php endwhile; ?>    
		<?php else : ?>
			<p>Page Not Found.</p>
		<?php endif; ?>
    </div>
<?php get_footer(); ?>