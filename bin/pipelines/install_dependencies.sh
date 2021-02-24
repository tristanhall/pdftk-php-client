#!/bin/bash

apt-get update || exit 1

# Install software packages
DEBIAN_FRONTEND=noninteractive apt-get install -yq software-properties-common apt-utils gnupg2 curl git unzip awscli || exit 1
DEBIAN_FRONTEND=noninteractive apt-get install -yq php php-json php-mbstring php-xml php-curl php-bcmath php-gd php-zip php-mysql || exit 1

which php

# Test PHP installation
/usr/bin/php --version || exit 1

# Install Composer
/usr/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" || exit 1
/usr/bin/php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" || exit 1
/usr/bin/php composer-setup.php || exit 1
/usr/bin/php -r "unlink('composer-setup.php');" || exit 1

# Install Composer globally
mv -f composer.phar /usr/local/bin/composer || exit 1

# Test Composer installation
/usr/local/bin/composer --version || exit 1

# Update APT repositories
apt-get update || exit 1