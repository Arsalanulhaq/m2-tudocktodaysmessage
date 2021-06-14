<?php
namespace Tudock\TodaysMessage\Model\ResourceModel\Message;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tudock\TodaysMessage\Model\Message as Model;
use Tudock\TodaysMessage\Model\ResourceModel\Message as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}