<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserStatus;

class UserStatusSeeder extends Seeder {

    private $table = 'user_statuses';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $statuses = ['active', 'inactive'];
        foreach ($statuses as $index => $value) {
            UserStatus::create([
                'id'    => ++$index,
                'name'  => $value
            ]);
        }
    }
}
