<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateObjServicesTable extends AbstractMigration
{
    const TABLE_NAME = "obj_services";

    public function up()
    {
        if (!$this->hasTable(self::TABLE_NAME)) {
            $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => 'id_service']);
            $table->addColumn('id_service', MysqlAdapter::PHINX_TYPE_INTEGER)
                ->addColumn('id_contract', MysqlAdapter::PHINX_TYPE_INTEGER)
                ->addColumn('title_service', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 250])
                ->addColumn('status', MysqlAdapter::PHINX_TYPE_ENUM,
                    [
                        'values' => [
                            'work',
                            'connecting',
                            'disconnected',
                        ],
                    ])
                ->create();
        } else {
            $table = $this->table(self::TABLE_NAME);
        }

        $table->addForeignKey(['id_contract'],
            'obj_contracts',
            'id_contract',
            [
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
            ])
        ->save();

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
