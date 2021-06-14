<?php   
namespace Tudock\TodaysMessage\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class Active
 *
 * @package VendorName\SysConfigTable\Block\System\Config\Form\Field
 */
class Fields extends AbstractFieldArray {

    /**
     * @var bool
     */
    protected $_addAfter = TRUE;

    /**
     * @var
     */
    protected $_addButtonLabel;

    /**
     * Construct
     */
    protected function _construct() {
        parent::_construct();
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare to render the columns
     */
    protected function _prepareToRender() {
        $this->addColumn('category', ['label' => __('Category')]);
        $this->addColumn('category_name', ['label' => __('Category Name')]);
        $this->addColumn('message', ['label' => __('Message')]);
        $this->_addAfter       = FALSE;
        $this->_addButtonLabel = __('Add Option');
    }
}