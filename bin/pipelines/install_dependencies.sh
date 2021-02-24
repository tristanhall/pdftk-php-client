#!/bin/bash

apt-get update || exit 1

# Install software packages
DEBIAN_FRONTEND=noninteractive apt-get install -yq software-properties-common apt-utils || exit 1
DEBIAN_FRONTEND=noninteractive apt-get install -yq php php-json || exit 1

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

# Configure Node.js repository
curl -sSL https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add -
echo "deb https://deb.nodesource.com/node_14.x focal main" | tee /etc/apt/sources.list.d/nodesource.list
echo "deb-src https://deb.nodesource.com/node_14.x focal main" | tee -a /etc/apt/sources.list.d/nodesource.list

# Update APT repositories
apt-get update || exit 1

# Install Node.js 14
DEBIAN_FRONTEND=noninteractive apt-get install -yq nodejs || exit 1