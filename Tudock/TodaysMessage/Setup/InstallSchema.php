<?php 
namespace Tudock\TodaysMessage\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        error_log('1111-');
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('category_product_message_map');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                            ->addColumn(
                                'id',
                                Table::TYPE_INTEGER,
                                null,
                                ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                            )
                            ->addColumn(
                                'cat_id',
                                Table::TYPE_INTEGER,
                                11,
                                ['nullable'=>false,'default'=>0]
                            )
                            ->addColumn(
                                'product_id',
                                Table::TYPE_INTEGER,
                                11,
                                ['nullable'=>false,'default'=>0]
                            )
                            ->addColumn(
                                'message',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>false,'default'=>'']
                            )
                            ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
?>