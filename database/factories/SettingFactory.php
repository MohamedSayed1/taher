<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sit_title_ar' => 'عدنان الطاهر',
            'sit_title_nl' => 'Adnan Eltaher',
            'sit_title_en' => 'Adnan Eltaher'
        ];
    }
}
