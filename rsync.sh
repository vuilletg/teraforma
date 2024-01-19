
#!/bin/bash

# Variables
read -p "Entrez votre login IUT: " remote_user
source_directory=$(pwd)  
remote_host="git@192.168.14.113"
remote_directory="/var/www/terraforma/"
ssh_proxy="transit.iut2.univ-grenoble-alpes.fr"

# Commande Rsync avec définition des permissions
rsync -av --exclude="$(basename $0)" --exclude=".git*" --exclude="git*" --exclude=".git/" --exclude=".git/*" --exclude=".git/.*" \
    -e "ssh -J $remote_user@$ssh_proxy" "$source_directory/" "$remote_host:$remote_directory" \
    --chmod=g+rX,o-rwx

# Assurez-vous d'avoir le groupe web comme propriétaire
ssh -J $remote_user@$ssh_proxy "$remote_host" "chown -R :web $remote_directory"
