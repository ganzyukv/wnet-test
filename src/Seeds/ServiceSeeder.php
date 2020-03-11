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
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'id_service'    => $i,
                'id_contract'   => mt_rand(1, 100),
                'title_service' => $faker->sentence(10),
                'status'        => $faker->randomElement(self::STATUSES),
            ];
        }

        $this->table(self::TABLE_NAME)->insert($data)->saveData();

    }

    public function getDependencies()
    {
        return [
            ContractSeeder::class,
        ];
    }
}
