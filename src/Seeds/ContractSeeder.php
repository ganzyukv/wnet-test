<?php


use Phinx\Seed\AbstractSeed;

class ContractSeeder extends AbstractSeed
{
    const TABLE_NAME = 'obj_contracts';

    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'id_contract'  => $i,
                'id_customer'  => $i,
                'number'       => $faker->unique(false, 1000000)->randomNumber(6),
                'date_sign'    => $faker->dateTimeInInterval('-1 years', '+100 days')->format('Y-m-d'),
                'staff_number' => $faker->unique(false, 1000000)->randomNumber(4),
            ];
        }

        $this->table(self::TABLE_NAME)->insert($data)->saveData();
    }

    public function getDependencies()
    {
        return [
            CustomerSeeder::class,
        ];
    }
}
