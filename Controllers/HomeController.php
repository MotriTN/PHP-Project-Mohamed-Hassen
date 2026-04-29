<?php

declare(strict_types=1);

class HomeController extends BaseController
{
    public function index(): void
    {
        $productManager = new ProductManager();
        
        $searchQuery = $_GET['q'] ?? '';
        
        if (!empty($searchQuery)) {
            $products = $productManager->search($searchQuery);
        } else {
            $products = $productManager->getAll();
        }

        $this->render('home', [
            'title' => 'Nexus - Premium Digital Gear',
            'products' => $products,
            'searchQuery' => $searchQuery
        ]);
    }
}
