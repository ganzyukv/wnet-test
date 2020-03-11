<?php


use Phinx\Seed\AbstractSeed;

class ServiceSeeder extends AbstractSeed
{
    const TABLE_NAME = 'obj_services';
    const STATUSES = [
        'work',
        'connecting',
        'disconnected',
    ];

    public function run()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->table(self::TABLE_NAME)->truncate();
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 1; $i <= 400; $i++) {
            $data[] = [
                'id_service'    => $i,
                'id_contract'   => mt_rand(1, 300),
                'title_service' => $faker->sentence(10),
                'status'        => $faker->randomElement(self::STATUSES),
            ];
        }

        $this->table(self::TABLE_NAME)->insert($data)->saveData();
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function getDependencies()
    {
        return [
            ContractSeeder::class,
        ];
    }
}
