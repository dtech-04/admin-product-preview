<?php


namespace Dtech\ProductPreview\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @param null $moduleName
     * @return bool
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        return parent::isModuleOutputEnabled('Dtech_ProductPreview');
    }

    /**
     * @return bool|mixed
     */
    public function isEnable(){
        if(!$this->isModuleOutputEnabled()){
            return false;
        }
        return $this->scopeConfig->getValue('product_preview/general/enable_module');
    }

    /**
     * @return bool|mixed
     */
    public function isPreviewInGrid(){
        if(!$this->isEnable()){
            return false;
        }
        return $this->scopeConfig->getValue('product_preview/general/preview_grid');
    }

    /**
     * @return bool|mixed
     */
    public function isPreviewInEdit(){
        if(!$this->isEnable()){
            return false;
        }
        return $this->scopeConfig->getValue('product_preview/general/preview_edit');
    }
}
