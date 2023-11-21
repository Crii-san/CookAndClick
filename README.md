# Symfony 

## AUTEUR 

Yasmina BOUHRIZ EL BOUHLALI
Line MARTINET
Christelle SOUKA
Thomas FONTAO


## Installation / Configuration
### Clonage / recuperations (pull) du projet 
_Les commandes_ : 

- ``git clone "URL du projet"`` -> permet de cloner le projet


- ``git pull`` -> permet de recuperer touts les elements du projets mis a jour par rapport au git
- ``composer install`` -> installe tous les elements composer presents dans les fichiers du projet

### Phpstorm
pour ouvrir le projet sur phpstrom -> ``phpstorm & .``
#### Attention : il faut penser a activiter 'symfony Suport' si pas deja fait  
Il faut installer 'PHP Cs fixer': 
- Cherchez le nom du paquet correspondant à CS Fixer avec  -> ``composer search cs-fixer``
- Lancez l'installation de PHP CS Fixer en utilisant la commande require combinée à l'option --dev de composer -> ``composer require friendsofphp/php-cs-fixer --dev``
- Faire les manipulation dans phpStorm File/settings/qualityTools.

### script composer
_Les commandes_ :  

- ``composer start``  -> lance le server web de symfony  
- ``test:cs`` -> lance la verification de code par PHP CS Fixer  
- ``fix:cs`` -> lance la correction du code par PHP CS Fixer  