<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\DiscussionStatus;

class DiscussionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discussionStatuses = [
            1 => 'Pending',
            2 => 'Awaiting Approve',
            3 => 'Active',
            4 => 'Inactive',
        ];
        foreach ($discussionStatuses as $key => $value) {
            DiscussionStatus::create([
                'id'    => $key,
                'name'  => $value,
                'slug'  => Str::slug($value)
            ]);
        }
    }
}
