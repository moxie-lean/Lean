#!/bin/bash

clear

echo ""
echo "Hi welcome, before install the required files please make sure you have installed"
echo "
 - node: https://nodejs.org/download/
 - bower: http://bower.io/#install-bower
"

echo "Are you ready to continue (enter: 1 or 0): "
select yn in "Yes" "No"; do
    case $yn in
        Yes ) ./bin/setup.sh; break;;
        No ) ./bin/bye.sh; exit;;
    esac
done
