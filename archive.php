<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu main" role="main">

	<?php if ( have_posts() ) : ?>

		<section>

			<?php

			$headr_open = '<h1 class="h1 article-title"><span class="title-style">';
			$headr_close = '</span></h1>';
			$current_term = single_term_title( "", false );

			/* If this is a category archive */
			if ( is_category() ) {

				echo $headr_open . 'Category: ';
				echo $current_term;
				echo $headr_close;

				/* If this is a tag archive */
			} elseif ( is_tag() ) {

				echo $headr_open . '';
				echo $current_term;
				echo $headr_close;

				/* If this is a Taxonomy */
			} elseif ( is_tax() ) {

				echo $headr_open . 'Archives: ';
				echo $current_term;
				echo $headr_close;

				/* If this is a daily archive */
			} elseif ( is_day() ) {
				?>
				<h2 class="pagetitle">Archive for <?php the_time( 'F jS, Y' ); ?></h2>
				<?php /* If this is a monthly archive */
			} elseif ( is_month() ) { ?>
				<h2 class="pagetitle">Archive for <?php the_time( 'F, Y' ); ?></h2>
				<?php /* If this is a yearly archive */
			} elseif ( is_year() ) { ?>
				<h2 class="pagetitle">Archive for <?php the_time( 'Y' ); ?></h2>
				<?php /* If this is an author archive */
			} elseif ( is_author() ) { ?>
				<h2 class="pagetitle">Author Archive</h2>
				<?php /* If this is a paged archive */
			} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
				<h2 class="pagetitle">Blog Archives</h2>
			<?php } ?>

			<nav>
				<div><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
				<div><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
			</nav>

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class() ?>>
					<header>
						<h3 id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
						<?php
							$mem_date = c12_date( get_the_ID() );
						?>
						<time datetime="<?php 
						echo date_i18n( "Y-m-d", $mem_date["start-unix"]) 
						?>"><?php 
						// the_time( 'l, F jS, Y' );
						echo date_i18n( "j F Y", $mem_date["start-unix"]) 
						?></time>
					</header>
					<?php // the_content() ?>
				</article>
			<?php endwhile; ?>

			<nav>
				<div><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
				<div><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
			</nav>
		</section>

	<?php
	else :

		if ( is_category() ) { // If this is a category archive
			printf( "<h2 class=\"h2\">Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title( '', false ) );
		} else {
			if ( is_date() ) { // If this is a date archive
				echo( "<h2 class=\"h2\">Sorry, but there aren't any posts with this date.</h2>" );
			} else {
				if ( is_author() ) { // If this is a category archive
					$userdata = get_userdatabylogin( get_query_var( 'author_name' ) );
					printf( "<h2 class=\"h2\">Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name );
				} else {
					echo( "<h2 class=\"h2\">No posts found.</h2>" );
				}
			}
		}
		get_search_form();

	endif;
	?>

</div>


<?php get_footer(); ?>
