<?php

namespace Dtech\ProductPreview\Plugin\Magento\Catalog\Ui\Component\Listing\Columns;

class ProductActions
{

    /**
     * @var \Magento\Framework\View\Element\UiComponent\ContextInterface
     */
    protected $context;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \Dtech\ProductPreview\Helper\Data
     */
    protected $helperData;

    /**
     * ProductAction constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Dtech\ProductPreview\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Dtech\ProductPreview\Helper\Data $helperData
    )
    {
        $this->context = $context;
        $this->urlBuilder = $urlBuilder;
        $this->productFactory = $productFactory;
        $this->helperData = $helperData;
    }

    /**
     * @param \Magento\Catalog\Ui\Component\Listing\Columns\ProductActions $subject
     * @param array $dataSource
     * @return array
     */
    public function afterPrepareDataSource(
        \Magento\Catalog\Ui\Component\Listing\Columns\ProductActions $subject,
        array $dataSource
    )
    {
        if ($this->getHelperData()->isPreviewInGrid()) {
            if (isset($dataSource['data']['items'])) {
                foreach ($dataSource['data']['items'] as &$item) {
                    $product = $this->productFactory->create()->load($item['entity_id']);
                    $productUrl = $product->getProductUrl();
                    $item[$subject->getData('name')]['product_preview'] = [
                        'href' => $productUrl,
                        'label' => __('Preview'),
                        'hidden' => false,
                        'target' => '_blank',
                    ];
                }
            }
        }
        return $dataSource;
    }

    /**
     * @return \Dtech\ProductPreview\Helper\Data
     */
    public function getHelperData()
    {
        return $this->helperData;
    }
}
