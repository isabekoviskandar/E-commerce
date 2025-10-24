<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Isabekoff',
            'email' => 'iskandarisabrkov@gmail.com',
            'password' => Hash::make('admin_password')
        ]);

        // Create a category
        $category = Category::create([
            'name_uz' => 'Dorilar',
            'name_ru' => 'Лекарства',
            'name_en' => 'Medicines',
        ]);

        // Create a product with 3 images
        Product::create([
            'category_id' => $category->id,
            'name_uz' => 'Paracetamol 500mg',
            'name_ru' => 'Парацетамол 500мг',
            'name_en' => 'Paracetamol 500mg',
            'description_uz' => 'Paracetamol - bu og\'riq va isitma uchun ishlatiladi. 500mg tabletkalar, 20 dona qutida.',
            'description_ru' => 'Парацетамол - используется при боли и лихорадке. Таблетки 500 мг, 20 штук в упаковке.',
            'description_en' => 'Paracetamol - used for pain and fever relief. 500mg tablets, 20 pieces per box.',
            'country_uz' => 'Hindiston',
            'country_ru' => 'Индия',
            'country_en' => 'India',
            'file' => null,
            'count' => 100,
            'price' => 25000,
            'image1' => 'images/image1.jpg',
            'image2' => 'images/image2.jpg',
            'image3' => 'images/image3.jpg',
        ]);

        // Create another product
        Product::create([
            'category_id' => $category->id,
            'name_uz' => 'Aspirin 100mg',
            'name_ru' => 'Аспирин 100мг',
            'name_en' => 'Aspirin 100mg',
            'description_uz' => 'Aspirin - qon ivishini oldini olish va og\'riq qoldirish uchun. 100mg tabletkalar.',
            'description_ru' => 'Аспирин - для предотвращения тромбообразования и обезболивания. Таблетки 100 мг.',
            'description_en' => 'Aspirin - for blood clot prevention and pain relief. 100mg tablets.',
            'country_uz' => 'Germaniya',
            'country_ru' => 'Германия',
            'country_en' => 'Germany',
            'file' => null,
            'count' => 150,
            'price' => 35000,
            'image1' => 'images/image1.jpg',
            'image2' => 'images/image2.jpg',
            'image3' => 'images/image3.jpg',
        ]);
    }
}