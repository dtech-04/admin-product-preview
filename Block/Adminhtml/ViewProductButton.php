<?php
namespace Dtech\ProductPreview\Block\Adminhtml;

class ViewProductButton extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $_product;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Store\Model\App\Emulation
     */
    protected $_emulation;

    /**
     * @var \Dtech\ProductPreview\Helper\Data
     */
    protected $helperData;

    /**
     * ViewProductButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Model\Product $product
     * @param \Magento\Store\Model\App\Emulation $emulation
     * @param \Dtech\ProductPreview\Helper\Data $helperData
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Product $product,
        \Magento\Store\Model\App\Emulation $emulation,
        \Dtech\ProductPreview\Helper\Data $helperData,
        array $data = []
    )
    {
        $this->helperData = $helperData;
        $this->_coreRegistry = $registry;
        $this->_product = $product;
        $this->_request = $context->getRequest();
        $this->_emulation = $emulation;
        parent::__construct($context, $data);
    }
    public function getHelperData()
    {
        return $this->helperData;
    }

    /**
     * Block constructor adds buttons
     *
     */
    protected function _construct()
    {
        if ($this->getHelperData()->isPreviewInEdit()) {
            $this->addButton(
                'preview_product',
                $this->getButtonData()
            );
        }
        parent::_construct();
    }

    /**
     * Return button attributes array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Preview'),
            'on_click' => sprintf("window.open('%s')", $this->_getProductUrl()),
            'class' => 'view disable',
            'sort_order' => 20
        ];
    }
    
    /**
     * Return product frontend url depends on active store
     *
     * @return mixed
     */
    protected function _getProductUrl()
    {
        $store = $this->_request->getParam('store');
        if (!$store) {
            $this->_emulation->startEnvironmentEmulation(null, \Magento\Framework\App\Area::AREA_FRONTEND, true);
            $productUrl = $this->_product->loadByAttribute('entity_id', $this->_coreRegistry->registry('product')->getId())->getProductUrl();
            $this->_emulation->stopEnvironmentEmulation();
            return $productUrl;
        } else {
            return $this->_product
                ->loadByAttribute('entity_id', $this->_coreRegistry->registry('product')->getId())
                ->setStoreId($store)->getUrlInStore();
        }
    }
}