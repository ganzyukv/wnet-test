<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateObjCustomersTable extends AbstractMigration
{
    const TABLE_NAME = "obj_customers";

    public function up()
    {
        if (!$this->hasTable(self::TABLE_NAME)) {
            $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => 'id_customer']);
            $table->addColumn('id_customer', MysqlAdapter::PHINX_TYPE_INTEGER)
                ->addColumn('name_customer', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 250])
                ->addColumn('company', MysqlAdapter::PHINX_TYPE_ENUM,
                    [
                        'values' => [
                            'company_1',
                            'company_2',
                            'company_3'
                        ]
                    ])
                ->create();
        }
    }

    public function down()
    {
        if ($this->hasTable(self::TABLE_NAME)) {
            $this->table(self::TABLE_NAME)
                ->drop()
                ->save();
        }
    }
}
