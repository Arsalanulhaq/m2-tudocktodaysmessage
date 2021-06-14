<?php
namespace Tudock\TodaysMessage\Model;

use Magento\Framework\Model\AbstractModel;
use Tudock\TodaysMessage\Model\ResourceModel\Message as ResourceModel;

class Message extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}