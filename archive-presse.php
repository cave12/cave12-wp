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
				
				.presse-item h2 {
					font-size: 1.2em;
					line-height: 1.2;
					margin-top: 1.8em;
					margin-bottom: 0;
				}
				
				.presse-item:first-of-type h2 {
					margin-top: 0;
				}
				
				.presse-fichier {
/*					padding-right: 1em;*/
/*					border:  1px solid #aaa;*/
					min-width: 12em;
				}
				
				.presse-fichier img {
					max-width: 100%;
					height: auto;
					border: 1px solid #aaa;
					
				}
				.presse-quote {
					padding: 1em;
					font-style: italic;
					font-size: 1.1em;
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
				
				/* Passage à 2 colonnes après une certaine largeur */
				
				@media screen and (min-width: 68em) {
				  .presse-items {
				    column-count: 2;	
						column-gap: 3em;
				  }
					
					.presse-item {
						-webkit-column-break-inside: avoid; /* Chrome, Safari, Opera */
						          page-break-inside: avoid; /* Firefox */
						               break-inside: avoid; /* IE 10+ */
					}
				}
				
			</style>
			
			<h1 class="pagetitle">Presse</h1>
			
			<div class="presse-items">

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
							
								// Produire le lien
								
								$c12_presse_img = wp_get_attachment_image_src(
									$c12_presse["c12_presse_fichier"]["ID"], 
									'full' 
								);
								
								echo '<a href="'.$c12_presse_img[0] .'" data-width="'.$c12_presse_img[1] .'" data-height="'.$c12_presse_img[2] .'">'; 
						
								// Produire l'image
							
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
									
								echo '</a>';
								
//								if ( current_user_can( 'edit_others_pages' ) ) {
//									echo '<pre>';
//									var_dump($c12_presse["c12_presse_fichier"]);
//									echo '</pre>';
//								}
								
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
			
			</div><!-- .presse-items -->

		</section>

	<?php

	endif;
	?>

</div>

<?php get_footer(); ?>
