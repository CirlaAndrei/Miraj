<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Rochie Elegantă Florală',
                'description' => 'Rochie elegantă cu imprimeu floral, perfectă pentru ocazii speciale. Material: viscoză de calitate superioară. Lungime: midi. Mărimi disponibile: XS-XL.',
                'price' => 299.99,
                'sale_price' => 249.99,
                'sku' => 'ROCH-001',
                'stock_quantity' => 15,
                'category' => 'Modă',
                'image' => 'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?w=600',
                'tags' => ['rochie', 'elegantă', 'floral', 'vară'],
                'is_featured' => true,
            ],
            [
                'name' => 'Colier Argint 925 cu Zirconii',
                'description' => 'Colier elegant din argint 925, cu pietre zirconii strălucitoare. Lungime ajustabilă: 40-45 cm. Închizătoare tip carabinier.',
                'price' => 159.99,
                'sale_price' => null,
                'sku' => 'ACC-023',
                'stock_quantity' => 8,
                'category' => 'Accesorii',
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=600',
                'tags' => ['colier', 'argint', 'bijuterie', 'zirconii'],
                'is_featured' => true,
            ],
            [
                'name' => 'Set Îngrijire Facială Premium',
                'description' => 'Set complet de îngrijire facială: demachiant bifazic, tonic, ser și cremă hidratantă. Potrivit pentru toate tipurile de ten.',
                'price' => 249.99,
                'sale_price' => 199.99,
                'sku' => 'BEAU-045',
                'stock_quantity' => 12,
                'category' => 'Îngrijire',
                'image' => 'https://images.unsplash.com/photo-1556229010-6c3f2c9ca5f8?w=600',
                'tags' => ['îngrijire', 'cosmetice', 'față', 'set cadou'],
                'is_featured' => true,
            ],
            [
                'name' => 'Geantă Piele Ecologică',
                'description' => 'Geantă tip tote din piele ecologică de calitate. Dimensiuni: 35x30x10 cm. Două compartimente, închidere cu fermoar. Curea ajustabilă.',
                'price' => 189.99,
                'sale_price' => 159.99,
                'sku' => 'ACC-089',
                'stock_quantity' => 6,
                'category' => 'Accesorii',
                'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600',
                'tags' => ['geantă', 'tote', 'piele ecologică', 'accesorii'],
                'is_featured' => false,
            ],
            [
                'name' => 'Parfum Floral de Vară',
                'description' => 'Parfum proaspăt cu note de cap: bergamotă și lămâie, note de inimă: iasomie și trandafir, note de bază: mosc și lemn de santal.',
                'price' => 179.99,
                'sale_price' => null,
                'sku' => 'FRAG-012',
                'stock_quantity' => 20,
                'category' => 'Parfumuri',
                'image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=600',
                'tags' => ['parfum', 'floral', 'vară', 'feminin'],
                'is_featured' => true,
            ],
            [
                'name' => 'Bluză Mătase Naturală',
                'description' => 'Bluză elegantă din mătase naturală 100%. Croială lejeră, mâneci scurte. Potrivită atât pentru birou, cât și pentru evenimente.',
                'price' => 199.99,
                'sale_price' => 179.99,
                'sku' => 'ROCH-067',
                'stock_quantity' => 10,
                'category' => 'Modă',
                'image' => 'https://images.unsplash.com/photo-1551046531-5d2194f5c7f4?w=600',
                'tags' => ['bluză', 'mătase', 'elegant', 'vară'],
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']) . '-' . uniqid(),
                'description' => $product['description'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'],
                'sku' => $product['sku'],
                'stock_quantity' => $product['stock_quantity'],
                'image' => $product['image'],
                'category' => $product['category'],
                'tags' => $product['tags'],
                'is_featured' => $product['is_featured'],
            ]);
        }

        $this->command->info('6 produse au fost adăugate cu succes!');
    }
}
