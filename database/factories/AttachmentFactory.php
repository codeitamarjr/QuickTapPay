<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'collection' => 'default',
            'disk' => config('filesystems.attachments_disk', config('filesystems.default')),
            'path' => 'attachments/' . Str::uuid() . '.png',
            'filename' => $this->faker->lexify('file-?????.png'),
            'mime_type' => 'image/png',
            'size' => $this->faker->numberBetween(10_000, 500_000),
            'uploaded_by' => User::factory(),
        ];
    }
}
