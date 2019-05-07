# Modèle Affiches

## Où se trouve le modèle des pages affiches?

Il y a deux modèles:

1) Affiches : page-templates/affiches.php

Ce modèle montre 3 affiches, par Xavier, Harrisson et Thomas, en utilisant la fonction c12_affiches().

2) Affiches par : affiches-par.php

Ce modèle utilise également la fonction c12_affiches().

## Où est définie la fonction c12_affiches() ?

Dans: functions/get-content.php

## Dans quel ordre sont elles montrées? 

Par le critère 'orderby'  => 'date', donc c'est la date d'ajout du fichier.

Remarque: ce serait souhaitable de les faire apparaître par **date de concert**. Or les dates des fichiers ne sont pas modifiables dans l'interface WP.

Pour régler ce problème, on a décidé de corriger automatiquement la date des fichiers pour les rendre identiques à celles des concerts.

On utilisera pour cela la fonction "c12_fix_affiches()", déjà utilisée pour produire une relation "parent > enfant" entre le concert et les affiches.

