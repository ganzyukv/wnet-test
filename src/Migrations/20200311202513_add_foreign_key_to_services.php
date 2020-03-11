<?php

use Phinx\Migration\AbstractMigration;

class AddForeignKeyToServices extends AbstractMigration
{
    const TABLE_NAME = 'obj_services';

    public function change()
    {
        $table = $this->table(self::TABLE_NAME);
        if (!$table->hasForeignKey('id_contract')) {
            $table->addForeignKey(['id_contract'],
                'obj_contracts',
                'id_contract',
                [
                    'delete' => 'CASCADE',
                ])
                ->save();
        }

    }
}
