<?php
namespace Tudock\TodaysMessage\Helper;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Helper\Context;
use Tudock\TodaysMessage\Model\Message;
use Tudock\TodaysMessage\Model\ResourceModel\Message as MessageResource;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
     * @var Car
     */
    private $message;
    /**
     * @var CarResource
     */
    private $messageResource;

	public function __construct(
        Context $context,
        Message $message,
        MessageResource $messageResource
    )
    {
        parent::__construct($context);
        $this->message = $message;
        $this->messageResource = $messageResource;
    }

    public function getConfig($config_path) {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCategoryProducts($cat_id) {
    	$cateinstance = ObjectManager::getInstance()->create('Magento\Catalog\Model\CategoryFactory');
		$categoryProducts = $cateinstance->create()->load($cat_id)->getProductCollection()->addAttributeToSelect('*');
		return $categoryProducts->getData();
    }

    public function CategoryProductMessageMapping() {
    	error_log('new-map');
    	$messageMap = $this->getConfig('message/general/message_mappings');
		if (empty($messageMap)) {
			return false;
		}
        if ($this->isSerialized($messageMap)) {
            $unserializer = ObjectManager::getInstance()->get(\Magento\Framework\Unserialize\Unserialize::class);
        } else {
            $unserializer = ObjectManager::getInstance()->get(\Magento\Framework\Serialize\Serializer\Json::class);
        }
        $messageMap = $unserializer->unserialize($messageMap);
        foreach ($messageMap as $key => $value) {
        	error_log($value['category']);
        	$categoryProducts = $this->getCategoryProducts($value['category']);
        	foreach ($categoryProducts as $products => $product) {
        		$mappingInfo['cat_id'] = $value['category'];
	        	$mappingInfo['product_id'] = $product['entity_id'];
	        	$mappingInfo['message'] = $value['message'];
	        	$this->saveCategoryProductMapping($mappingInfo);
        	}
        }
    }

    public function saveCategoryProductMapping($mappingInfo) {
    	error_log('----');
    	/* Set the data in the model */
        $messageModel = $this->message;
        $messageModel->setData($mappingInfo);
        try {
            /* Use the resource model to save the model in the DB */
            // error_log('save-data-before');
            $this->messageResource->save($messageModel);
            // error_log('save-data-after');
            // $this->messageManager->addSuccessMessage("Messages mapped successfully!");
        } catch (\Exception $exception) {
            // $this->messageManager->addErrorMessage(__("Error saving data"));
            // error_log('save-data-error');
        }
    }

    /**
     * Check if value is a serialized string
     *
     * @param string $value
     * @return boolean
     */
    private function isSerialized($value)
    {
        return (boolean) preg_match('/^((s|i|d|b|a|O|C):|N;)/', $value);
    }
}