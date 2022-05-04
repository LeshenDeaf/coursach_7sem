<?php

namespace Database\Seeders;

use App\Models\Forum\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $initializators = [
            ['name' => 'Общедомовые собрания',],
            ['name' => 'Вопросы парковки',],
            ['name' => 'О субботниках',],
            ['name' => 'Капремонт',],
            ['name' => 'Вопросы к УК',],
            ['name' => 'Вакансии',],
        ];

        foreach ($initializators as $initializator) {
            Category::create($initializator);
        }
    }
}
