<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nameOptions = [
            $this->faker->colorName . ' ' . $this->faker->word,
            $this->faker->firstName . "'s " . $this->faker->randomElement(['Classic', 'Premium', 'Deluxe']) . ' ' . $this->faker->word,
            $this->faker->randomElement(['Organic', 'Natural', 'Handmade']) . ' ' . $this->faker->word,
            $this->faker->randomNumber(2) . ' ' . $this->faker->randomElement(['Pack', 'Set', 'Bundle']) . ' of ' . $this->faker->word,
        ];

        $name = $this->faker->randomElement($nameOptions);
        $name = substr($name, 0, 30); // Limit name to 30 characters


        // Generate random RGB values for black, red, or white shades
        $colorOptions = [
            sprintf('%02X%02X%02X', rand(0, 50), rand(0, 50), rand(0, 50)), // Dark shades
            sprintf('%02X%02X%02X', rand(200, 255), rand(0, 50), rand(0, 50)), // Red shades
            sprintf('%02X%02X%02X', rand(200, 255), rand(200, 255), rand(200, 255)), // Light shades
        ];
        $color = $this->faker->randomElement($colorOptions);

        // Calculate the luminance of the color
        list($r, $g, $b) = sscanf($color, "%02x%02x%02x");
        $luminance = 0.299 * $r + 0.587 * $g + 0.114 * $b;

        // Encode the product name for use in the URL
        $encodedName = urlencode($name);

        // Choose text color based on luminance
        $textColor = $luminance > 186 ? '000000' : 'ffffff'; // Black text for light backgrounds, white text for dark backgrounds

        return [
            'name' => $name,
            'image' => 'https://dummyimage.com/480x480/' . $color . '/' . $textColor . '&text=' . $encodedName,
            'size' => $this->faker->randomElement([
                'XS', 'S', 'M', 'L', 'XL', 'XXL',     // Cloth size
                '38', '39', '40', '41', '42', '43',  // Shoe sizee
            ]),
            'desc' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(0, 9999),
            'stock' => $this->faker->numberBetween(10, 20),
            'brand_id' => function () {
                return Brand::inRandomOrder()->first()->id;
            },
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'enable' => $this->faker->boolean(90), // 90% chances of being enabled
        ];
    }
}
