---
layout: page
title: Galeries et images
---

## Les taxonomies des images

### La taxonomie Affiches

Les images possèdent une taxonomie "Affiches". Dans cette taxonomie existent trois termes: "par Harrisson", "par Thomas Perrodin", "par Xavier Robel" (on pourrait en ajouter d'autres).

Cette taxonomie est déclarée dans functions > taxonomies.php, et disponible uniquement pour les fichiers joints. Elle permet de distinguer les affiches des autres fichiers, et de les classifier par auteur.

### La taxonomie Photos

Les images possèdent une taxonomie "Photos" qui permet de trier les photos par type. Elle est déclarée au même endroit que "Affiches" ci-dessus. Les termes dans cette taxonomie: Diaporama, Concerts, Public, Locaux, Chantier.

## Comment sont gérées les galeries d'images?

On utilise l'extension "**[Lightbox with PhotoSwipe](https://wordpress.org/plugins/lightbox-photoswipe/)**". 

### Quel code est nécessaire pour faire fonctionner cette Lightbox?

Théoriquement aucun, l'extension devrait détecter les structures de balises. Voir [cette info sur le forum](https://wordpress.org/support/topic/required-data-attributes-on-link/).

Dans la pratique, il semble nécessaire d'ajouter deux attributs sur les balises des liens-images:

- `data-lbwps-width` (anciennement `data-width`).
- `data-lbwps-height` (anciennement `data-height`).





## Historique:

- Ticket #16: [Trouver script galerie d'images](https://github.com/cave12/cave12-wp/issues/16) 

- [Ajout de code](https://github.com/cave12/cave12-wp/commit/0a34b8453f0d70782f70c968f2e7ba173fcc1efa) ajoutant les paramètres data-width et data-height, dans archive-presse.php et affiches.php.
- [Question posée](https://wordpress.org/support/topic/required-data-attributes-on-link/) sur le forum de l'extension



