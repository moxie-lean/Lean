#!/bin/bash

echo ""
echo "==========================================================================="
echo "                 Installing Packages from Node - By Nolte                  "
echo "==========================================================================="
echo "Running: npm install, wait, please."
echo ""
npm install
echo ""
echo "==========================================================================="
echo "                Installing Packages from Bower - By Nolte                  "
echo "==========================================================================="
echo "Running: bower install, wait, please."
echo ""
bower install
echo ""
echo "==========================================================================="
echo "               Installing Packages from Composer - By Nolte                "
echo "==========================================================================="
echo "Get latest version of composer"
curl -sS https://getcomposer.org/installer | php
echo "Running: composer install && composer update, wait, please."
php composer.phar install && php composer.phar update
echo ""
echo "==========================================================================="
echo "               Create CSS and JS Assets - By Nolte                "
echo "==========================================================================="
gulp assets
echo "Installation complete, thank you!"

./bin/bye.sh
