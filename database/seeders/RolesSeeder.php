<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    protected $roles = [
        [
            'id' => 1,
            'name' => 'Не сотрудник',
            'slug' => 'user',
        ],
        [
            'id' => 2,
            'name' => 'Администратор',
            'slug' => 'admin',
        ],
        [
            'id' => 3,
            'name' => 'Менеджер',
            'slug' => 'manager',
        ],
    ];

    public function run()
    {
        foreach ($this->roles as $index => $role) {
            $result = DB::table('roles')->insert($role);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted ' . count($this->roles) . ' records.');
    }
}
