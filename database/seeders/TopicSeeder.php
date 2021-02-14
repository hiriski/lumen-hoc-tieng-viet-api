<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = [
            1 => 'Topic 1',
            2 => 'Topic 2',
            3 => 'Topic 3'
        ];
        foreach ($topics as $key => $value) {
            Topic::create([
                'id'    => $key,
                'name'  => $value,
                'slug'  => Str::slug($value)
            ]);
        }
    }
}
