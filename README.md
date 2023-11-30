# <div align="center">SAÉ3.01 : Développement d’une application</div>

## <div align="center">Auteurs</div>
<div align="center">Yasmina BOUHRIZ EL BOUHLALI</div>  
<div align="center">Line MARTINET</div> 
<div align="center">Christelle SOUKA</div>
<div align="center">Thomas FONTAO</div>

## Installation / Configuration

### Clonage / Récupération du projet 
_Les commandes_ : 

- ``git clone https://iut-info.univ-reims.fr/gitlab/bouh0039/sae3-01`` -> permet de cloner le projet
- ``git pull`` -> permet de récupérer tous les éléments du projet mis à jour par rapport au git
- ``composer install`` -> installe tous les éléments composer présents dans les fichiers du projet

### Phpstorm
Pour ouvrir le projet sur phpstrom -> ``phpstorm & .``

#### Attention : il faut penser à activer 'Symfony Support' si ça n'est pas déjà fait.
Installation de "PHP CS Fixer" : 
- Chercher le nom du paquet correspondant à PHP CS Fixer avec -> ``composer search cs-fixer``
- Lancer l'installation de PHP CS Fixer en utilisant la commande require combinée à l'option --dev de composer -> ``composer require friendsofphp/php-cs-fixer --dev``
- Faire les manipulations dans phpStorm : File/settings/qualityTools.

### Scripts Composer
_Les commandes_ :  

- ``composer start``  -> lance le serveur web de symfony  
- ``test:cs`` -> lance la vérification du code par PHP CS Fixer  
- ``fix:cs`` -> lance la correction du code par PHP CS Fixer
- ``db`` -> realise toutes le commandes pour re-générer la base de données compléte

### Installation .env.local pour l'accés a la Base de Données
- Il faut copier le .env et le renomer en .env.local.
- Ensuite il suffit de remplacer la URI par : 
        ``DATABASE_URL="mysql://[identifient]:[mot de passe]@mysql:3306/[le nom de la bd]?version=10.2.25"``
