<?php

use Phinx\Migration\AbstractMigration;

class AddForeignKeyToContracts extends AbstractMigration
{
    const TABLE_NAME = 'obj_contracts';

    public function change()
    {
        $table = $this->table(self::TABLE_NAME);
        if (!$table->hasForeignKey('id_customer')) {
            $table->addForeignKey(['id_customer'],
                'obj_customers',
                'id_customer',
                [
                    'delete' => 'CASCADE',
                ])
                ->save();
        }

    }
}
