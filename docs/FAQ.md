---
layout: page
title: FAQ
permalink: faq.html
---

# FAQ du site Cave12

### Comment est faite la mise en page, quels sont les éléments principaux?

Il y a trois parties principales:

- L'en-tête : titre et navigation
- Le contenu principal
- La barre latérale (à gauche)

Dans le code: un div#page englobe le tout.

 #header - a une position fixe, reste toujours visible.
 
 #contenu .contenu - il a un grand padding à gauche pour laisser la place au menu. Le positionnement est appliqué sur ".contenu"

### Quels sont les relations entre contenus?

Explicatifs dans [https://github.com/cave12/migration-spip-wp](https://github.com/cave12/migration-spip-wp)


### Production de liens sur les URL du contenu, comment ça fonctionne?

Dans le contenu des articles, il y a fréquemment des URL pointant vers les sites des articles. Il faut une procédure automatique pour leur ajouter le code HTML nécessaire à un lien.

Dans single.php, on applique ceci:

`$c12_content = c12_process_hyperlinks($c12_content);`



### Gestion du LazyLoad, comment ça fonctionne?

On utilise un script "LazyLoad" pour optimiser le chargement des pages ayant beaucoup d'images (la section Affiches). Le script utilisé provient du theme [WPRig](https://wprig.io/). C'est une version modifiée du script LazyLoad de Jetpack.

### Gestion du iCal, comment ça fonctionne?

Sous Spip:  L’adresse des événements d’un site SPIP au format iCal est :

spip.php?page=ical

Donc pour le site archive: https://www.cave12.org/spip-archive/spip.php?page=ical

Voir https://www.spip.net/fr_article2390.html

On utilisait un .htaccess rewrite, pour l'adresse suivante:  
http://www.cave12.org/cave12.ics

Méthode utilisée dans SPIP:

```
### Custom ical .ics rule
Options +FollowSymlinks
RewriteEngine On
RewriteRule cave12.ics /spip.php?page=ical [L]
```

Nouvelle méthode dans WordPress:

```
Options +FollowSymlinks
RewriteEngine On
RewriteRule cave12.ics /?p=1782 [L]
```

À noter que ceci ne fonctionne pas : `RewriteRule cave12.ics /ical/ [L]`  
La raison: /ical/ est une adresse fictive, qui a elle-même besoin d'un rewrite pour fonctionner. Il faut utiliser /?p=1782 qui renvoie directement au bon article.

Un validateur: https://icalendar.org/validator.html

Les URL possibles:

- https://www.cave12.org/cave12.ics
- webcal://cave12.org/cave12.ics
- https://www.cave12.org/ical/
- https://www.cave12.org/?p=1782

***