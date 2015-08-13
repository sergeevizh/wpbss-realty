<?php
/**
 * The template for displaying all single posts.
 *
 * @package wpbss
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8 col-xs-12 pull-right">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="row">
					<?php if(has_post_thumbnail()): ?>
						<div class="col-md-5">
							<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'thumbnail img-responsive' )); ?></a>
						</div>
					<?php endif; ?>
					<div class="col-md-7">
						<header class="entry-header">

							<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

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

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
