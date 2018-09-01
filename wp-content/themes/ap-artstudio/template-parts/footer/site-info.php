<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
	<span>Copyright &copy; <?php date('Y'); ?> <?php echo get_bloginfo('name'); ?></span><br>
	<a href="<?php echo esc_url( __( 'https://#/', 'twentyseventeen' ) ); ?>" class="imprint">
		<?php printf( __( 'Web design by %s', 'twentyseventeen' ), 'AP Art Studio' ); ?>
	</a>
</div><!-- .site-info -->
