<B_retest_age>
<BOUCLE_retest_age(ARTICLES){id_article}{age<1}> 
</BOUCLE_retest_age>
	<?php 
	
	// test if current an article has a current event date
			
	// if yes: output CSS and mini calendar
	
	 ?>

		<BOUCLE_article_courant(ARTICLES){id_article}>
				<style>.concert-no-#ID_ARTICLE a {
					background: #ce0000;
					color:#fff;
					box-shadow: inset 0 0 8px rgb(122, 11, 11);
				}
				.concert-no-#ID_ARTICLE a:hover {
					color: #fff;
				}
				
				</style>
		</BOUCLE_article_courant>
		
		<INCLURE{fond=inc-minical}>
		
</B_retest_age>

[(#ENV{contexte}|=={sommaire}|?{
	[(#INCLURE{fond=inc-minical})],
	''
})]