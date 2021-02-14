<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\DiscussionType;

class DiscussionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discussionTypes = [
            1 => 'Thread',
            2 => 'Question'
        ];
        foreach ($discussionTypes as $key => $value) {
            DiscussionType::create([
                'id'    => $key,
                'name'  => $value,
                'slug'  => Str::slug($value)
            ]);
        }
    }
}
