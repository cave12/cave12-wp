---
layout: page
title: Galeries
---

## Comment sont gérées les galeries d'images?

On utilise l'extension "**[Lightbox with PhotoSwipe](https://wordpress.org/plugins/lightbox-photoswipe/)**". 

### Quel code est nécessaire pour faire fonctionner cette Lightbox?

Théoriquement aucun, l'extension détecte devrait détecter les structures de balises. Voir [cette info sur le forum](https://wordpress.org/support/topic/required-data-attributes-on-link/).

Dans la pratique, il semble nécessaire d'ajouter deux attributs sur les balises des liens-images:

- `data-lbwps-width` (anciennement `data-width`).
- `data-lbwps-height` (anciennement `data-height`).



## Historique:

- Ticket #16: [Trouver script galerie d'images](https://github.com/cave12/cave12-wp/issues/16) 

- [Ajout de code](https://github.com/cave12/cave12-wp/commit/0a34b8453f0d70782f70c968f2e7ba173fcc1efa) ajoutant les paramètres data-width et data-height, dans archive-presse.php et affiches.php.
- [Question posée](https://wordpress.org/support/topic/required-data-attributes-on-link/) sur le forum de l'extension



