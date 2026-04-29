<?php

declare(strict_types=1);

class CartController extends BaseController
{
    private ProductManager $productManager;

    public function __construct()
    {
        // Ensure session cart array exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->productManager = new ProductManager();
    }

    /**
     * View the shopping cart.
     */
    public function index(): void
    {
        $cartItems = [];
        $totalAmount = 0.0;

        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->productManager->getById((int)$productId);
            if ($product) {
                $subtotal = $product->getPrice() * $quantity;
                $totalAmount += $subtotal;
                
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }

        $this->render('cart', [
            'title' => 'Your Cart - Nexus',
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(): void
    {
        $productId = (int)($_GET['id'] ?? 0);
        
        if ($productId > 0) {
            $product = $this->productManager->getById($productId);
            if ($product) {
                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId]++;
                } else {
                    $_SESSION['cart'][$productId] = 1;
                }
            }
        }
        
        // Redirect back to home or to cart
        $this->redirect('/projet2/Public/index.php/cart/index');
    }

    /**
     * Remove a product from the cart completely.
     */
    public function remove(): void
    {
        $productId = (int)($_GET['id'] ?? 0);
        
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        
        $this->redirect('/projet2/Public/index.php/cart/index');
    }

    /**
     * Checkout process (mockup).
     */
    public function checkout(): void
    {
        // In a full implementation, this would insert into `orders` and `order_items` tables
        // For now, we just clear the cart and show a success message.
        $_SESSION['cart'] = [];
        echo "<h2>Order placed successfully!</h2><p><a href='/projet2/Public/index.php'>Return to store</a></p>";
        exit;
    }
}
