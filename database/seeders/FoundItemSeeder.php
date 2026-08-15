<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FoundItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class FoundItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $securityAdmin = User::where('role', 'security_admin')->first();

        if (! $securityAdmin) {
            return;
        }

        $items = [
            ['item_name' => 'Black Wallet', 'category' => 'Bags & Wallets', 'color' => 'Black', 'brand_model' => null, 'location_found' => 'Main Cafeteria', 'storage_location' => 'Security Office Shelf A'],
            ['item_name' => 'iPhone 13', 'category' => 'Electronics', 'color' => 'Blue', 'brand_model' => 'Apple iPhone 13', 'location_found' => 'Library, 2nd Floor', 'storage_location' => 'Security Office Locker 3'],
            ['item_name' => 'Student ID Card', 'category' => 'Documents & ID Cards', 'color' => null, 'brand_model' => null, 'location_found' => 'Parking Lot B', 'storage_location' => 'Security Office Drawer 1'],
            ['item_name' => 'House Keys', 'category' => 'Keys', 'color' => null, 'brand_model' => null, 'location_found' => 'Gymnasium', 'storage_location' => 'Security Office Key Box'],
            ['item_name' => 'Grey Hoodie', 'category' => 'Clothing', 'color' => 'Grey', 'brand_model' => null, 'location_found' => 'Auditorium', 'storage_location' => 'Security Office Shelf B'],
            ['item_name' => 'Scientific Calculator', 'category' => 'Books & Stationery', 'color' => 'Black', 'brand_model' => 'Casio fx-991', 'location_found' => 'Room 204, Block C', 'storage_location' => 'Security Office Shelf A'],
        ];

        foreach ($items as $index => $item) {
            $category = Category::where('name', $item['category'])->first();

            FoundItem::firstOrCreate(
                ['item_name' => $item['item_name'], 'location_found' => $item['location_found']],
                [
                    'logged_by' => $securityAdmin->id,
                    'category_id' => $category?->id,
                    'color' => $item['color'],
                    'brand_model' => $item['brand_model'],
                    'date_found' => now()->subDays($index + 1)->toDateString(),
                    'time_found' => '10:00',
                    'storage_location' => $item['storage_location'],
                    'description' => null,
                    'status' => 'in_storage',
                ]
            );
        }
    }
}
