#!/bin/bash

clear

echo ""
echo "Hi welcome, before install the required files please make sure you have installed"
echo "
 - node: https://nodejs.org/download/
 - bower: http://bower.io/#install-bower
"
 # - composer: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

bye(){
  echo ""
  echo "Thanks! Have a great day."
  echo ""
}

install(){
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
  # echo ""
  # echo "==========================================================================="
  # echo "               Installing Packages from Composer - By Moxie                "
  # echo "==========================================================================="
  # echo "Running: composer install && composer update, wait, please."
  # composer install && composer update
  echo "Installation complete, thank you!"
  bye
}


echo "Are you ready to continue (enter: 1 or 0): "
select yn in "Yes" "No"; do
    case $yn in
        Yes ) install; break;;
        No ) bye; exit;;
    esac
done
