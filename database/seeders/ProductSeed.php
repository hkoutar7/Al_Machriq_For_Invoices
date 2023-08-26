<?php

    namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

    class ProductSeed extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            DB::table('products')->delete();

    DB::table('products')->insert([
        'product_name' => 'بطاقة الائتمان',
        'description' => 'هذه البطاقة مفيدة للتسوق عبر الإنترنت',
        'section_id' => '1',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة ماستر كارد',
        'description' => 'هذه البطاقة مفيدة للتسوق عبر الإنترنت وغيرها',
        'section_id' => '2',
    ]);

    DB::table('products')->insert([
        'product_name' => 'قرض الكلية',
        'description' => 'هذا القرض مفيد للتسوق عبر الإنترنت',
        'section_id' => '3',
    ]);

    DB::table('products')->insert([
        'product_name' => 'كود 30',
        'description' => 'هذا العرض للمراهقين بين 18 و 30 عامًا',
        'section_id' => '2',
    ]);

    // Additional seed data
    DB::table('products')->insert([
        'product_name' => 'حساب التوفير',
        'description' => 'هذا الحساب مخصص لتوفير الأموال',
        'section_id' => '1',
    ]);

    DB::table('products')->insert([
        'product_name' => 'قرض المنزل',
        'description' => 'هذا القرض مفيد لشراء منزلك الجديد',
        'section_id' => '3',
    ]);

    DB::table('products')->insert([
        'product_name' => 'حساب الاستثمار',
        'description' => 'هذا الحساب مخصص للاستثمار في الأسهم والسندات',
        'section_id' => '1',
    ]);

    DB::table('products')->insert([
    'product_name' => 'بطاقة الصراف الآلي',
    'description' => 'هذه البطاقة تسمح لك بسحب النقد من الصراف الآلي',
    'section_id' => '2',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة الشحن',
        'description' => 'هذه البطاقة تسمح لك بشحن رصيد هاتفك المحمول',
        'section_id' => '6',
    ]);

    DB::table('products')->insert([
        'product_name' => 'تأمين السيارة',
        'description' => 'هذا التأمين يغطي الأضرار المحتملة لسيارتك',
        'section_id' => '5',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة الائتمان',
        'description' => 'هذه البطاقة مفيدة للتسوق عبر الإنترنت',
        'section_id' => '6',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة ماستر كارد',
        'description' => 'هذه البطاقة مفيدة للتسوق عبر الإنترنت وغيرها',
        'section_id' => '2',
    ]);

    DB::table('products')->insert([
        'product_name' => 'قرض الكلية',
        'description' => 'هذا القرض مفيد للتعليم الجامعي والدراسات العُليا',
        'section_id' => '5',
    ]);

    DB::table('products')->insert([
        'product_name' => 'تأمين السيارة',
        'description' => 'هذا التأمين يغطي الأضرار المحتملة لسيارتك',
        'section_id' => '2',
    ]);

    DB::table('products')->insert([
        'product_name' => 'حساب التوفير',
        'description' => 'هذا الحساب يسمح لك بادخار المال مع تحقيق عائد عليه',
        'section_id' => '6',
    ]);

    DB::table('products')->insert([
        'product_name' => 'قرض المنزل',
        'description' => 'هذا القرض مفيد لشراء منزلك الجديد',
        'section_id' => '3',
    ]);

    DB::table('products')->insert([
        'product_name' => 'حساب الاستثمار',
        'description' => 'هذا الحساب مخصص للاستثمار في الأسهم والسندات',
        'section_id' => '8',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة الصراف الآلي',
        'description' => 'هذه البطاقة تسمح لك بسحب النقد من الصراف الآلي',
        'section_id' => '7',
    ]);

    DB::table('products')->insert([
        'product_name' => 'بطاقة الشحن',
        'description' => 'هذه البطاقة تسمح لك بشحن رصيد هاتفك المحمول',
        'section_id' => '7',
    ]);



        }
    }
