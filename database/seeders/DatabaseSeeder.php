<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // System admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@mahorapos.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'shop_id'  => null,
        ]);

        // Demo shop + owner
        $shop = Shop::create([
            'name'                  => 'Demo Cafe',
            'subscription_status'   => 'active',
            'subscription_end_date' => now()->addDays(30),
        ]);

        $owner = User::create([
            'name'     => 'Demo Owner',
            'email'    => 'owner@democafe.com',
            'password' => Hash::make('password'),
            'role'     => 'owner',
            'shop_id'  => $shop->id,
        ]);

        $shop->update(['owner_id' => $owner->id]);

        // Demo cashier
        User::create([
            'name'     => 'Demo Cashier',
            'email'    => 'cashier@democafe.com',
            'password' => Hash::make('password'),
            'role'     => 'cashier',
            'shop_id'  => $shop->id,
        ]);

        // Demo staff
        User::create([
            'name'     => 'Demo Staff',
            'email'    => 'staff@democafe.com',
            'password' => Hash::make('password'),
            'role'     => 'staff',
            'shop_id'  => $shop->id,
        ]);

        // Demo products
        $products = [
            ['name' => 'Espresso',       'price' => 5.00,  'stock' => 100],
            ['name' => 'Latte',          'price' => 7.50,  'stock' => 80],
            ['name' => 'Croissant',      'price' => 4.50,  'stock' => 30],
            ['name' => 'Iced Americano', 'price' => 6.00,  'stock' => 5],
            ['name' => 'Cheesecake',     'price' => 12.00, 'stock' => 0],
        ];

        foreach ($products as $p) {
            Product::create(array_merge($p, ['shop_id' => $shop->id]));
        }
    }
}
