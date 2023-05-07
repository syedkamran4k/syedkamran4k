<?php


namespace MyMod\Agent\Ui\DataProvider\Info;

use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Product collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public $objectManager;
    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public $collection;

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    public $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    public $addFilterStrategies;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \MyMod\Agent\Model\ResourceModel\Account\CollectionFactory $collectionFactory
     * @param array  $addFieldStrategies
     * @param array  $addFilterStrategies
     * @param array  $meta
     * @param array  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \MyMod\Agent\Model\ResourceModel\Info\Grid\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }

        $items = $this->getCollection()->getData();
//        echo '<pre>'; print_r($items);  die('<--$grid data');
        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),

        ];
    }

    public function getSearchCriteria()
    {
        return $this->getCollection();
    }
}
