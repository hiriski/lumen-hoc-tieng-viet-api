<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserStatus;

class UserStatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $userStatus = [
            1 => 'Active',
            2 => 'Inactive'
        ];
        foreach ($userStatus as $key => $value) {
            UserStatus::create([
                'id'    => $key,
                'name'  => $value
            ]);
        }
    }
}
