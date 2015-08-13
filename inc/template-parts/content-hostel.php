<?php
/**
 * Template part for displaying posts.
 *
 * @package wpbss
 */

$location = get_field('address');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-5">
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'thumbnail img-responsive' )); ?></a>
			<?php else: ?>
				<?php
					if( !empty($location) ):
						echo do_shortcode('[su_gmap address="' . $location['lat'] . ' ' .$location['lng'] . '"]');
		 			endif;
				?>
			<?php endif; ?>

		</div>
		<div class="col-md-7">
			<header class="entry-header">

				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

				<div class="meta-hostel">
					<p><span class="glyphicon glyphicon-map-marker"></span> <?php echo $location["address"]; ?></p>
					<p><span class="glyphicon glyphicon-earphone"></span> <?php echo get_field("phone"); ?></p>
					<?php
						$link = get_field('www');
						if(!empty($link)): ?>
							<p><a href="<?php echo $link ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-link"></span> Сайт</a></p>
						<?php endif; ?>
				</div>
			</header><!-- .entry-header -->
		</div>
	</div>
	<div class="entry-content">
		<?php
            if ( is_single() ) {
                /* translators: %s: Name of current post */
                the_content( sprintf(
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wpbss' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
            } else {
	               the_excerpt();
            }
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpbss' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wpbss_entry_footer(); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wpbss_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
