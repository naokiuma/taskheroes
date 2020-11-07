<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'テスト投稿',
            'body' => 'これはテスト投稿です。',
            'categories_id' => '1',
            'user_id' => '1'
        ]);
    }
}
