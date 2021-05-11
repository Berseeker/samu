<?php

namespace Database\Factories;

use App\Models\AtributosDinamicos;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtributosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AtributosDinamicos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->factory->name(),
            'inputType_id' => $this->factory->numberBetween(1, 10),
            'producto_id' => $this->factory->numberBetween(1, 100),
        ];
    }
}
