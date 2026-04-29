<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Your Cart') ?></title>
    <link rel="stylesheet" href="/projet2/Public/assets/css/style.css">
    <style>
        .cart-container { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .cart-table { width: 100%; border-collapse: collapse; background: var(--bg-card); margin-bottom: 2rem; border-radius: 8px; overflow: hidden; }
        .cart-table th, .cart-table td { padding: 1.5rem; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .cart-table th { background: rgba(0,0,0,0.3); color: var(--accent-neon); text-transform: uppercase; font-size: 0.9rem; }
        .cart-total { display: flex; justify-content: flex-end; align-items: center; gap: 2rem; font-size: 1.5rem; font-weight: 800; background: rgba(0, 229, 255, 0.05); padding: 2rem; border-radius: 8px; }
        .cart-total span { color: var(--accent-neon); font-size: 2rem; }
        .remove-btn { color: #ff4757; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
        .remove-btn:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="/projet2/Public/index.php" class="brand-logo">NEXUS <span>.</span></a>
        <nav>
            <ul class="nav-links">
                <li><a href="/projet2/Public/index.php">Continue Shopping</a></li>
            </ul>
        </nav>
    </header>

    <main class="cart-container">
        <h1 style="margin-bottom: 2rem;">Your Cart</h1>

        <?php if (empty($cartItems)): ?>
            <div style="text-align: center; padding: 5rem; background: var(--bg-card); border-radius: 8px;">
                <h2 style="color: var(--text-muted); margin-bottom: 1rem;">Your cart is empty.</h2>
                <a href="/projet2/Public/index.php" class="btn btn-primary">Discover Gear</a>
            </div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td style="font-weight: 600;"><?= htmlspecialchars($item['product']->getName()) ?></td>
                            <td><?= number_format($item['product']->getPrice(), 2) ?> TND</td>
                            <td><?= $item['quantity'] ?></td>
                            <td style="color: var(--accent-neon); font-weight: 600;"><?= number_format($item['subtotal'], 2) ?> TND</td>
                            <td>
                                <a href="/projet2/Public/index.php/cart/remove?id=<?= $item['product']->getId() ?>" class="remove-btn">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-total">
                <div>Total:</div>
                <span><?= number_format($totalAmount, 2) ?> TND</span>
                <a href="/projet2/Public/index.php/cart/checkout" class="btn btn-primary" style="margin-left: 2rem;">Secure Checkout</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
