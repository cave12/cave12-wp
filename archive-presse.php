<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu main" role="main">

	<?php if ( have_posts() ) : ?>

		<section>
			
			<style>
				.presse-item-content {
					display: flex;
				}
				.presse-fichier {
/*					padding-right: 1em;*/
/*					border:  1px solid #aaa;*/
					min-width: 12em;
				}
				
				.presse-fichier  img {
					max-width: 100%;
					height: auto;
				}
				.presse-quote {
					padding: 1em;
					font-style: italic;
					font-size: 1.2em;
				}
				
				.presse-quote p:first-of-type::before {
					content: '«\00A0';
				}
				.presse-quote p:last-of-type::after {
					content: '\00A0»';
				}
				
				.presse-item .download {
					font-size: 0.9em;
				}
				.presse-item .download::before {
					content:  "↧ ";
				}
			</style>
			
			<h1 class="pagetitle">Presse</h1>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php 
				
				// Produce ACF fields
				
				$c12_presse["c12_presse_fichier"] = get_field( 'c12_presse_fichier' );
				
				$c12_presse["c12_presse_source"] = get_field( 'c12_presse_source' );
				
				$c12_presse["c12_presse_date"] = get_field( 'c12_presse_date' );
				
				 ?>
				<article <?php post_class("presse-item") ?>>
					<header>
						<h2 id="post-<?php the_ID(); ?>" class="presse-title">
							<?php the_title(); ?>
						</h2>
						<?php 
						
						if ($c12_presse["c12_presse_source"]) {
						
							echo '<p class="small small-mono">'.$c12_presse["c12_presse_source"];
							
							echo ', '. date("d.m.Y", strtotime( $c12_presse["c12_presse_date"] ));
							
							echo '</p>';
							
						}
						
						 ?>
						
					</header>
					<div class="presse-item-content">
						<?php
						
						if ($c12_presse["c12_presse_fichier"]) {
						
							echo '<div class="presse-fichier">';
						
								if ( $c12_presse["c12_presse_fichier"]["mime_type"] == "application/pdf" ) {
								
									// echo '<p>(Produce PDF preview!)</p>';	
											
									echo wp_get_attachment_image( 
										$c12_presse["c12_presse_fichier"]["ID"], 
										'medium' 
									);	
								
								} else if ( $c12_presse["c12_presse_fichier"]["type"] == "image" ) {
								
									$c12_presse_file = $c12_presse["c12_presse_fichier"]["url"];
									
									if (!empty( $c12_presse["c12_presse_fichier"]["sizes"]["large"] )) {
									
										$c12_presse_file = $c12_presse["c12_presse_fichier"]["sizes"]["large"];
									}
									
									echo '<img src="'.$c12_presse_file.'" />';
																	
								}
								
//								echo '<pre>';
//								var_dump($c12_presse["c12_presse_fichier"]);
//								echo '</pre>';
								
								// Download Link
								
								echo '<a class="download" href="'.$c12_presse["c12_presse_fichier"]["url"].'">';
								
								echo 'Télécharger';
								if ( $c12_presse["c12_presse_fichier"]["mime_type"] == "application/pdf") {
										echo ' (PDF)';							
								}
								echo '</a>';
								
							echo '</div>';
							
						}
						?>
						<div class="presse-quote">
								<?php  the_content(); ?>
						</div>
					</div><!-- presse-item-content -->
					
				</article>
			<?php endwhile; ?>

		</section>

	<?php

	endif;
	?>

</div>

<?php get_footer(); ?>
