<?php

namespace Database\Factories;

use App\Models\TreeItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tree>
 */
class TreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'tree_item_id' => TreeItem::factory()->create()->id,
            'is_public' => true,
            'user_id' => (User::query()->count() > 0) ? User::query()->first()->id : User::factory()->create()->id
        ];
    }
}
