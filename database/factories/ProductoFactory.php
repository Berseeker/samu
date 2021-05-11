<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SKU' => $this->factory->title(),
            'nombre' => $this->factory->name(),
            'descripcion' => $this->factory->text(),
            'stock' => $this->factory->numberBetween(0, 500),
            'precio_unitario' => $this->factory->randomFloat(2, 1, 500),
            'material' => $this->factory->randomElement($array = array ('plastico','metal','madera')), // 'b',
            'peso_producto' => $this->factory->randomFloat(2, 1, 500),
            'tienda_id' => 1,
            'subcategoria_id' => 2,
            'seccion_id' => Seccion::Factory()
        ];
    }
}
