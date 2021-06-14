<?php
namespace Tudock\TodaysMessage\Model\Indexer;

class MessageMap implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
	protected $helper;

	public function __construct(\Tudock\TodaysMessage\Helper\Data $helper)
    {
        $this->helper = $helper;
    }

	/*
	 * Used by mview, allows process indexer in the "Update on schedule" mode
	 */
	public function execute($ids){

		//code here!
		error_log('11');
	}

	/*
	 * Will take all of the data and reindex
	 * Will run when reindex via command line
	 */
	public function executeFull(){
		//code here!
		error_log('22');
		$this->helper->CategoryProductMessageMapping();
	}
   
   
	/*
	 * Works with a set of entity changed (may be massaction)
	 */
	public function executeList(array $ids){
		//code here!
		error_log('33');
	}
   
   
	/*
	 * Works in runtime for a single entity using plugins
	 */
	public function executeRow($id){
		//code here!
		error_log('44');
	}
}