---
layout: page
title: Affiches
---

## Où se trouve le modèle des pages affiches?

Il y a deux modèles:

1) Affiches : page-templates/affiches.php

Ce modèle montre 3 affiches, par auteur (Xavier, Harrisson et Thomas), en utilisant la fonction c12_affiches().

2) Affiches par : affiches-par.php

Ce modèle utilise également la fonction c12_affiches().

## Où est définie la fonction c12_affiches() ?

Dans: functions/get-content.php

## Dans quel ordre sont elles montrées? 

Par le critère 'orderby'  => 'date', donc c'est la date d'ajout du fichier.

Remarque: ce serait souhaitable de les faire apparaître par **date de concert**. Or les dates des fichiers ne sont pas modifiables dans l'interface WP.

Pour régler ce problème, on a décidé de corriger automatiquement la date des fichiers pour les rendre identiques à celles des concerts.

On utilise pour cela la fonction "c12_fix_affiches()", déjà utilisée pour produire une relation "parent > enfant" entre le concert et les affiches.

Cette fonction va s'exécuter si on visite la page du concert en question. Ce n'est donc pas immédiat.

## Comment les affiches sont-elles liées aux concerts?

- Relation via post_parent = le fichier a été uploadé sur un article. Son champ "post_parent" contient l'ID de l'article.
- Relation via un custom field, c12_spip_article_id
- Relation via ACF = champ ACF "galerie".