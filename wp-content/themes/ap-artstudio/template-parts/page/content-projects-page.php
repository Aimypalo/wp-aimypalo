<?php
/**
 * Displays content for projects page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$projects = get_field('projects');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twentyseventeen_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		
		<?php if ($projects) : ?>
			<div class="projects grid">
				<?php foreach ($projects as $post) : ?>
					<?php setup_postdata($post); 
					$project_thumb_id = get_field('project_thumb');
					$project_thumb = wp_get_attachment_image_src($project_thumb_id, 'project-thumb');
					$project_thumb = $project_thumb[0];
					?>
					<div class="grid-item grid-xs-12 grid-s-6 grid-md-4">
						<a href="<?php the_permalink(); ?>">
							<div class="image-wrapper">
								<img src="<?php echo $project_thumb; ?>" alt="<?php the_title(); ?>">
							</div>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		
		<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->