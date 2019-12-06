# Dtech Module ProductPreview

    ``dtech/module-productpreview``

 - [Main Functionalities](#user-content-main-functionalities)
 - [Installation](#user-content-installation)
 - [Configuration](#user-content-configuration)
 - [Specifications](#user-content-specifications)


## Main Functionalities

	This module provide link of preview product in admin product grid and product view.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Dtech`
 - Enable the module by running `php bin/magento module:enable Dtech_ProductPreview`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer
 - If you do not know what Composer is, please read [this](https://getcomposer.org/doc/00-intro.md) first.
 - Install the module composer by running `composer require dtech/module-productpreview:dev-master`
 - enable the module by running `php bin/magento module:enable Dtech_ProductPreview`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Enable (productpreview/general/enable_module)

 - Preview Grid (productpreview/general/preview_grid)

 - Preview Edit (productpreview/general/preview_edit)


## Specifications

 - Plugin
	- afterPrepareDataSource - Magento\Catalog\Ui\Component\Listing\Columns\ProductActions > Dtech\ProductPreview\Plugin\Magento\Catalog\Ui\Component\Listing\Columns\ProductActions

 - Helper
	- Dtech\ProductPreview\Helper\Data
