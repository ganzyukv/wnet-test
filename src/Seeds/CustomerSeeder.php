<?php


use Phinx\Seed\AbstractSeed;

class CustomerSeeder extends AbstractSeed
{
    const TABLE_NAME = 'obj_customers';
    const COMPANIES = [
        'company_1',
        'company_2',
        'company_3',
    ];

    public function run()
    {
        $this->table(self::TABLE_NAME)->truncate();
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'id_customer'   => $i,
                'name_customer' => $faker->userName,
                'company'       => $faker->randomElement(self::COMPANIES),
            ];
        }

        $this->table(self::TABLE_NAME)->insert($data)->saveData();
    }
}
