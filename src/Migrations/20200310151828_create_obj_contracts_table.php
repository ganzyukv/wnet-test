<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateObjContractsTable extends AbstractMigration
{
    const TABLE_NAME = "obj_contracts";

    public function up()
    {
        if (!$this->hasTable(self::TABLE_NAME)) {
            $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => 'id_contract']);

            $table->addColumn('id_contract', MysqlAdapter::PHINX_TYPE_INTEGER)
                ->addColumn('id_customer', MysqlAdapter::PHINX_TYPE_INTEGER)
                ->addColumn('number', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 100])
                ->addColumn('date_sign', MysqlAdapter::PHINX_TYPE_DATE)
                ->addColumn('staff_number', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 100])
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
