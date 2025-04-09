<?php

namespace Database\Seeders;

use App\Enums\UserGateEnum;
use App\Models\Car;
use App\Models\Configuration;
use App\Models\ConfigurationOption;
use App\Models\Option;
use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@staff.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'gate' => UserGateEnum::ADMIN->value
        ]);
        
        $carVwG4 = Car::factory()->create(['name' => 'Volkswagen Golf 4']);
        $carTCamry = Car::factory()->create(['name' => 'Toyota Camry']);

        $optClimate = Option::factory()->create(['name' => 'Climate control']);
        $optLeather = Option::factory()->create(['name' => 'Leather Seats']);
        $optSunRoof = Option::factory()->create(['name' => 'Sunroof']);

        $cfgTCamryComfort = Configuration::factory()->create(['car_id' => $carTCamry->id, 'name' => 'Comfort']);
        $cfgTCamryPremium = Configuration::factory()->create(['car_id' => $carTCamry->id, 'name' => 'Premium']);
        $cfgVwG4Lux = Configuration::factory()->create(['car_id' => $carVwG4->id, 'name' => 'Lux']);
        $cfgVwG4Prestige = Configuration::factory()->create(['car_id' => $carVwG4->id, 'name' => 'Prestige']);

        foreach ([$optClimate, $optLeather] as $option) {
            ConfigurationOption::factory()->create([
                'configuration_id' => $cfgTCamryComfort->id,
                'option_id' => $option->id
            ]);
        }

        foreach ([$optClimate, $optLeather, $optSunRoof] as $option) {
            ConfigurationOption::factory()->create([
                'configuration_id' => $cfgTCamryPremium->id,
                'option_id' => $option->id
            ]);
        }

        foreach ([$optClimate] as $option) {
            ConfigurationOption::factory()->create([
                'configuration_id' => $cfgVwG4Lux->id,
                'option_id' => $option->id
            ]);
        }

        foreach ([$optClimate, $optLeather, $optSunRoof] as $option) {
            ConfigurationOption::factory()->create([
                'configuration_id' => $cfgVwG4Prestige->id,
                'option_id' => $option->id
            ]);
        }

        // set available prices for toyota camry comfort and premium
        Price::factory()->create([
            'configuration_id' => $cfgTCamryComfort->id,
            'price' => 35000,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'end_date' => now()->addWeek()->format('Y-m-d H:i:s'),
        ]);

        Price::factory()->create([
            'configuration_id' => $cfgTCamryPremium->id,
            'price' => 40000,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'end_date' => now()->addMonths()->format('Y-m-d H:i:s'),
        ]);

        // set available prices for vw golf 4 Lux
        Price::factory()->create([
            'configuration_id' => $cfgVwG4Lux->id,
            'price' => 12500,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'end_date' => now()->addWeek()->format('Y-m-d H:i:s'),
        ]);

        // set prices for vw golf 4 Prestige (after 10 minutes this row will not displayed because unavailable dates)
        Price::factory()->create([
            'configuration_id' => $cfgVwG4Prestige->id,
            'price' => 33600,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'end_date' => now()->addMinutes(10)->format('Y-m-d H:i:s'),
        ]);
    }
}
