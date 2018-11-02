<?php

use Illuminate\Database\Seeder;

use App\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Let's truncate our existing records to start from scratch.
        Page::truncate();

        Page::create([
                'title'   => 'Sample Page',
                'slug'    => 'sample-page',
                'content' => 'This is the sample page.',
            ]);
    }
}
