<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin',
            'permissions' => '["moderator_list","moderator_create","moderator_update","moderator_delete","role_list","role_create","role_update","role_delete"]',
        ];
    }
}
