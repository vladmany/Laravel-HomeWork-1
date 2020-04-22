<?php

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Genre(['name' => 'Без жанра']))->save();
        (new Genre(['name' => 'Боевик']))->save();
        (new Genre(['name' => 'Фэнтези']))->save();
        (new Genre(['name' => 'Приключения']))->save();
        (new Genre(['name' => 'Роман']))->save();
        (new Genre(['name' => 'Для детей']))->save();
        (new Genre(['name' => 'Документальное']))->save();
        (new Genre(['name' => 'Дом и семья']))->save();
        (new Genre(['name' => 'Компьютеры и интернет']))->save();
        (new Genre(['name' => 'Научно-образовательное']))->save();
        (new Genre(['name' => 'Поэзия и драматургия']))->save();
        (new Genre(['name' => 'Проза']))->save();
        (new Genre(['name' => 'Религия и духовность']))->save();
        (new Genre(['name' => 'Современная литература']))->save();
        (new Genre(['name' => 'Справочная литература']))->save();
        (new Genre(['name' => 'Экономика']))->save();
        (new Genre(['name' => 'Юмор']))->save();
    }
}
