<?php

declare(strict_types=1);

class HomeController extends BaseController
{
    public function index(): void
    {
        // In a real scenario, we'd fetch featured products via ProductManager
        // $productManager = new ProductManager();
        // $products = $productManager->getAll();

        // For scaffolding, we pass mock data to demonstrate the view structure
        $products = [
            (new Product())->setId(1)->setName('Neon Keyboard')->setPrice(149.99)->setImageUrl('/projet2/Public/assets/images/neon-keyboard.jpg')->setDescription('High-performance mechanical keyboard with RGB neon accents.'),
            (new Product())->setId(2)->setName('Cyber Mouse')->setPrice(89.50)->setImageUrl('/projet2/Public/assets/images/cyber-mouse.jpg')->setDescription('Precision laser mouse optimized for high-speed gaming.'),
            (new Product())->setId(3)->setName('Quantum Headset')->setPrice(210.00)->setImageUrl('/projet2/Public/assets/images/quantum-headset.jpg')->setDescription('Immersive 7.1 surround sound with noise cancellation.')
        ];

        $this->render('home', [
            'title' => 'Nexus - Premium Digital Gear',
            'products' => $products
        ]);
    }
}
