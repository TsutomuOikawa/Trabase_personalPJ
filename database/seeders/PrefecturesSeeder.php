<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrefecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prefectures')->insert([
            ['pref_id' => 1, 'pref_name' => '北海道'],
            ['pref_id' => 2, 'pref_name' => '青森県'],
            ['pref_id' => 2, 'pref_name' => '岩手県'],
            ['pref_id' => 2, 'pref_name' => '宮城県'],
            ['pref_id' => 2, 'pref_name' => '秋田県'],
            ['pref_id' => 2, 'pref_name' => '山形県'],
            ['pref_id' => 2, 'pref_name' => '福島県'],
            ['pref_id' => 3, 'pref_name' => '茨城県'],
            ['pref_id' => 3, 'pref_name' => '栃木県'],
            ['pref_id' => 3, 'pref_name' => '群馬県'],
            ['pref_id' => 3, 'pref_name' => '埼玉県'],
            ['pref_id' => 3, 'pref_name' => '千葉県'],
            ['pref_id' => 3, 'pref_name' => '東京都'],
            ['pref_id' => 3, 'pref_name' => '神奈川県'],
            ['pref_id' => 4, 'pref_name' => '新潟県'],
            ['pref_id' => 4, 'pref_name' => '富山県'],
            ['pref_id' => 4, 'pref_name' => '石川県'],
            ['pref_id' => 4, 'pref_name' => '福井県'],
            ['pref_id' => 4, 'pref_name' => '山梨県'],
            ['pref_id' => 4, 'pref_name' => '長野県'],
            ['pref_id' => 4, 'pref_name' => '岐阜県'],
            ['pref_id' => 4, 'pref_name' => '静岡県'],
            ['pref_id' => 4, 'pref_name' => '愛知県'],
            ['pref_id' => 5, 'pref_name' => '三重県'],
            ['pref_id' => 5, 'pref_name' => '滋賀県'],
            ['pref_id' => 5, 'pref_name' => '京都府'],
            ['pref_id' => 5, 'pref_name' => '大阪府'],
            ['pref_id' => 5, 'pref_name' => '兵庫県'],
            ['pref_id' => 5, 'pref_name' => '奈良県'],
            ['pref_id' => 5, 'pref_name' => '和歌山県'],
            ['pref_id' => 6, 'pref_name' => '鳥取県'],
            ['pref_id' => 6, 'pref_name' => '島根県'],
            ['pref_id' => 6, 'pref_name' => '岡山県'],
            ['pref_id' => 6, 'pref_name' => '広島県'],
            ['pref_id' => 6, 'pref_name' => '山口県'],
            ['pref_id' => 7, 'pref_name' => '徳島県'],
            ['pref_id' => 7, 'pref_name' => '香川県'],
            ['pref_id' => 7, 'pref_name' => '愛媛県'],
            ['pref_id' => 7, 'pref_name' => '高知県'],
            ['pref_id' => 8, 'pref_name' => '福岡県'],
            ['pref_id' => 8, 'pref_name' => '佐賀県'],
            ['pref_id' => 8, 'pref_name' => '長崎県'],
            ['pref_id' => 8, 'pref_name' => '熊本県'],
            ['pref_id' => 8, 'pref_name' => '大分県'],
            ['pref_id' => 8, 'pref_name' => '宮崎県'],
            ['pref_id' => 8, 'pref_name' => '鹿児島県'],
            ['pref_id' => 8, 'pref_name' => '沖縄県']
        ])
    }
}
