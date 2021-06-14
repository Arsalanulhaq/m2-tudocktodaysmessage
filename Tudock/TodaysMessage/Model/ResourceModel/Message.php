<?php
namespace Tudock\TodaysMessage\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Message extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('category_product_message_map', 'id');
    }
}