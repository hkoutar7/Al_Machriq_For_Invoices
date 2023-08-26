<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->delete();

        DB::table('sections')->insert([
        'section_name' => 'بنك أفريقيا',
        'description' => 'مقر هذا البنك يقع في المغرب، وهو بنك مغربي بنسبة 100٪',
        'user_id' => 1,
        'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'بنك الشابي',
            'description' => 'بنك الشابي يساعدك على تطوير عملك',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'section_name' => 'بنك المغرب',
            'description' => 'بنك مركزي يقع في المملكة المغربية',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'البنك الشعبي',
            'description' => 'بنك يهدف إلى دعم الاقتصاد المصري والتنمية الاجتماعية',
            'user_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'section_name' => 'بنك القاهرة',
            'description' => 'أحد أقدم البنوك في مصر ويقدم مجموعة متنوعة من الخدمات المصرفية',
            'user_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'البنك العربي الأفريقي الدولي',
            'description' => 'بنك دولي يقدم خدمات مصرفية متميزة وحلول مالية مبتكرة',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'بنك القرض الحسن',
            'description' => 'بنك إسلامي يعتمد على المبادئ الشرعية في تقديم الخدمات المصرفية',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'بنك النيل',
            'description' => 'بنك مصري يقدم حلولًا مصرفية شاملة للأفراد والشركات',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'section_name' => 'بنك تشيس',
            'description' => 'أحد أكبر البنوك في الولايات المتحدة الأمريكية، يقدم مجموعة واسعة من الخدمات المصرفية.',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'بنك أوف أمريكا',
            'description' => 'بنك رئيسي في الولايات المتحدة الأمريكية يقدم خدمات مصرفية واستثمارية متنوعة.',
            'user_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sections')->insert([
            'section_name' => 'ويلز فارجو',
            'description' => 'شركة خدمات مالية متنوعة تمتلك وجودًا قويًا في الولايات المتحدة الأمريكية.',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
