# Magento 2 Add To Links Ajax

Add To Links Ajax

## Features:

### Category page
- new template for add to wishlist link
- new template for add to compare link
### Product page
- new template for add to wishlist link
- new template for add to compare link

## Installing the Extension

    composer require magekey/module-add-to-links

## Deployment

    php bin/magento maintenance:enable                  #Enable maintenance mode
    php bin/magento setup:upgrade                       #Updates the Magento software
    php bin/magento setup:di:compile                    #Compile dependencies
    php bin/magento setup:static-content:deploy         #Deploys static view files
    php bin/magento cache:flush                         #Flush cache
    php bin/magento maintenance:disable                 #Disable maintenance mode

## Versions tested
> 2.1.8
