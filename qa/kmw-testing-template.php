<?php
/**
 * Template Name: KMW Testing
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

	<div id="primary" class="content-area" style="width: 100%;">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
            the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">

                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <p>This is a page to make sure the template functions still work in templates. It might be very broken depending on the theme you are using.</p>

                    <h2>Truncate</h2>
                    <?php

                    $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec felis non justo imperdiet scelerisque. Curabitur ac pretium ante. Maecenas id sem non enim mattis finibus. Ut bibendum dolor non condimentum dictum. Sed vel leo ex. Praesent ornare, nisl vitae mattis aliquet, tortor felis lobortis turpis, sed consequat leo massa eu lorem. Sed in tortor imperdiet, tempor risus congue, rutrum enim. Duis accumsan blandit viverra. Aliquam lobortis, enim nec accumsan tincidunt, augue urna volutpat neque, in pellentesque ligula ipsum ac diam. Sed semper vulputate interdum. Integer quis quam turpis. Etiam vitae sem eu erat mattis posuere id eget ex. Ut nisi urna, interdum a posuere nec, mollis nec est. Nunc non dignissim ligula, vel molestie neque.";

                    echo kmw_truncate($content);
                    ?>

                    <h2>Category Sort</h2>
                    <?php echo kmw_sort_categories(); ?>

                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div><!-- .entry-content -->

                <?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Edit <span class="screen-reader-text">%s</span>', '_s' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer><!-- .entry-footer -->
                <?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
