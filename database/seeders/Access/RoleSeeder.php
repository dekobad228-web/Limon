<?php

namespace Database\Seeders\Access;

use App\Models\Access\Role;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $this->createRole();
        } catch (Exception $e) {
            $this->command->error($e->getMessage());
            exit;
        }
    }

    private function createRole(): void
    {
        foreach ($this::roles() as $name => $description) {
            Role::firstOrCreate(
                [
                    'name' => $name
                ],
                [
                    'name' => $name,
                    'description' => $description
                ]
            );
        }
    }

    static private function roles(): array
    {
        return [
            'admin' => 'Администратор',
            'editor' => 'Редактор',
            'moderator' => 'Модератор',
            'user' => 'Пользователь'
        ];
    }
}
