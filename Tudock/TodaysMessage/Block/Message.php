<?php
namespace Tudock\TodaysMessage\Block;

use Magento\Framework\View\Element\Template;
use Tudock\TodaysMessage\Model\ResourceModel\Message\Collection;

class Message extends Template
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Hello constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collection = $collection;
    }

    public function getAllMessages($productID) {
        $collection = $this->collection->addFieldToFilter('product_id',['eq'=>$productID]);
        $collection->setPageSize(1);
        $collection->getSelect()->orderRand();
        error_log($collection->getSelect());
        // return $this->collection;
        return $collection;
    }
    
}
