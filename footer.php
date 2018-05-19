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
			</ul>
			
			<?php get_search_form(); ?>
			
		</div><!--#pied-->
  
</div><!--#page-->

	<!-- Piwik -->
	<script type="text/javascript">
	var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.cave12.org/piwik/" : "http://www.cave12.org/piwik/");
	document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
	</script><script type="text/javascript">
	try {
	var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
	piwikTracker.trackPageView();
	piwikTracker.enableLinkTracking();
	} catch( err ) {}
	</script><noscript><p><img src="https://www.cave12.org/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
	<!-- End Piwik Tracking Code -->

  <?php wp_footer(); ?>

</body>
</html>
