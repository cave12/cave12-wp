<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
		
		<div id="pied" class="pied bloc-navig">
		
			<?php if ( has_nav_menu( 'menu-one' ) ) : ?>
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'menu-one',
							'container' => false,
							'menu_class' => 'navigation navigation-top',
							'menu_id'     => 'navigation',
						) );
					?>
			<?php endif; ?>
			
			
			<?php if ( has_nav_menu( 'menu-two' ) ) : ?>
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'menu-two',
							'container' => false,
							'menu_class' => 'navigation',
							'menu_id'     => '',
						) );
					?>
			<?php endif; ?>
			
			</ul>
			
			<?php if ( has_nav_menu( 'menu-three' ) ) : ?>
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'menu-three',
							'container' => false,
							'menu_class' => 'navigation',
							'menu_id'     => '',
						) );
					?>
			<?php endif; ?>
			
			<ul role="navigation" class="navigation nav-special">
				<li><a href="http://www.ville-ge.ch/culture/prixVdG11/laureat_musique.html" class="prix-ville-geneve" target="_blank">prix 2011 de la ville de genève</a></li>
			</ul>
			
			<ul role="navigation" class="navigation">
			<!--<li><a href="http://rss.cave12.org/cave12" title="S'abonner au RSS" rel="alternate" type="application/rss+xml">RSS</a></li>-->
				<li><a href="webcal://cave12.org/cave12.ics" title="S'abonner au calendrier">ical</a></li>
				<li><a href="https://www.cave12.org/feed/" title="S'abonner au flux de syndication">rss</a></li>
			</ul>
			
			<?php get_search_form(); ?>
			
		</div><!--#pied-->
  
</div><!--#page-->

  <?php wp_footer(); ?>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-25051761-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'UA-25051761-1');
	</script>
	
</body>
</html>
