#!/bin/bash

echo ""
echo "==========================================================================="
echo "                 Installing Packages from Node - By Moxie                  "
echo "==========================================================================="
echo "Running: npm install, wait, please."
echo ""
npm install
echo ""
echo "==========================================================================="
echo "                Installing Packages from Bower - By Moxie                  "
echo "==========================================================================="
echo "Running: bower install, wait, please."
echo ""
bower install
echo ""
echo "==========================================================================="
echo "               Installing Packages from Composer - By Moxie                "
echo "==========================================================================="
echo "Get latest version of composer"
curl -sS https://getcomposer.org/installer | php
echo "Running: composer install && composer update, wait, please."
composer install && composer update
echo ""
echo "==========================================================================="
echo "               Create CSS and JS Assets - By Moxie                "
echo "==========================================================================="
gulp js && gulp styles
echo "Installation complete, thank you!"

./bin/bye.sh
