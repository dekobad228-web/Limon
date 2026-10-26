<?php

namespace Database\Seeders\Access;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Access\Permission;
use Exception;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $this->createPermission($this::list());
        } catch (Exception $e) {
            $this->command->error($e->getMessage());
            exit;
        }
    }

    private function createPermission(array $list, ?string $instance = null): void
    {

        foreach ($list as $key => $value) {
            if (array_any($list, fn($value) => is_array($value))) {
                $this->createPermission($value, ($instance != null) ? implode(".", [$instance, $key]) : $key);
            } else {
                [$name, $description] = explode(':', $value);
                Permission::firstOrCreate(
                    [
                        'name' => $name
                    ],
                    [
                        'name' => "$instance.$name",
                        'description' => $description
                    ]
                );
            }
        }
    }

    static private function list(): array
    {
        return [
            'chats' => [
                'view:Просматривать свои чаты',
                'create:Создавать свои чаты',
                'delete:Удалять свои чаты',
                'add_members:Добавлять участников',
                'remove_members:Удалять участников',
            ],
            'messages' => [
                'view:Просматривать сообщения',
                'send:Отправлять сообщения',
                'edit:Редактировать свои сообщения',
                'delete:Удалять свои сообщения',
                'delete_any:Удалять чужие сообщения',
                'react:Ставить реакции'
            ],
            'admin' => [
                'users' => [
                    'view:Просматривать всех пользователей',
                    'ban:Блокировать пользователей',
                    'unban:Снимать блокировку'
                ],
                'roles' => [
                    'view:Просматривать роли',
                    'create:Создавать роли',
                    'update:Изменять роли',
                    'delete:Удалять роли',
                    'manage:Назначать роли'
                ],
                'permissions' => [
                    'view:Просматривать права',
                    'create:Создавать права',
                    'update:Изменять права',
                    'delete:Удалять права',
                    'manage:Назначать права'
                ],
                'audit' => [
                    'view:Просматривать дашборд статистистики'
                ]
            ]
        ];
    }
}
