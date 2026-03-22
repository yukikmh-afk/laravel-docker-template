<?php

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //テストデータを投入する際には念の為テーブルを空っぽにして全員のスタート地点を揃える
	    DB::table('todos')->truncate();
	    //
	    $testData = [
		[
			    'content' => 'PHP APPセクションを終える',
			    'created_at' => now(),
			    'updated_at' => now(),
		],
		[
			'content' => 'Laravel Lessonを終える',
			'created_at' => now(),
			'updated_at' => now(),
		]
	    ];
	    DB::table('todos')->insert($testData);
    }
}
