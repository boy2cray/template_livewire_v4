<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = \App\Models\Karyawan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nik'        => $this->faker->unique()->numerify(str_repeat('#', 16)),
            'nama'       => $this->faker->name(),
            'jk'         => $this->faker->randomElement(['L', 'P']),
            'asal'       => $this->faker->city(),
            'tgl_lahir'  => $this->faker->dateTimeBetween('-60 years', '-25 years')->format('Y-m-d'),
            'alamat'     => $this->faker->optional()->address(),
            'nohp'       => $this->faker->phoneNumber(),
            'file'       => null,
        ];
    }
}
