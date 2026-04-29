<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nexus - Premium Digital Gear. High-performance peripherals for elite gamers and creators.">
    <title><?= htmlspecialchars($title ?? 'Nexus Store') ?></title>
    <!-- Use relative path from the perspective of the browser hitting index.php -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

    <header class="site-header">
        <a href="<?= BASE_URL ?>/index.php" class="brand-logo">
            NEXUS <span>.</span>
        </a>
        <nav>
            <ul class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="<?= BASE_URL ?>/index.php/admin/index">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="<?= BASE_URL ?>/index.php/auth/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/index.php/auth/login">Sign In</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Upgrade Your <span>Reality</span></h1>
            <p>Discover our curated collection of elite digital gear. Engineered for performance, designed for aesthetics.</p>
            
            <form action="<?= BASE_URL ?>/index.php" method="GET" style="margin: 2rem auto; max-width: 500px; display: flex; gap: 0.5rem;">
                <input type="text" name="q" placeholder="Search products..." value="<?= htmlspecialchars($searchQuery ?? '') ?>" 
                       style="flex: 1; padding: 0.8rem; border-radius: 4px; border: 1px solid var(--accent-neon); background: rgba(0,0,0,0.5); color: white;">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            
            <a href="#products" class="btn btn-primary">Explore Gear</a>
        </section>

        <section id="products" class="container">
            <h2 class="section-title">Featured Drops</h2>
            
            <div class="products-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <article class="product-card">
                            <div class="product-image-wrapper">
                                <!-- Fallback if image doesn't exist -->
                                <?php if ($product->getImageUrl()): ?>
                                    <div class="image-placeholder">
                                        <?= htmlspecialchars($product->getName()) ?> Image
                                    </div>
                                <?php else: ?>
                                    <div class="image-placeholder">No Image</div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name"><?= htmlspecialchars($product->getName()) ?></h3>
                                <p class="product-desc"><?= htmlspecialchars($product->getDescription()) ?></p>
                                
                                <div class="product-footer">
                                    <div class="product-price"><?= number_format($product->getPrice(), 2) ?> TND</div>
                                    <a href="<?= BASE_URL ?>/index.php/cart/add?id=<?= $product->getId() ?>" class="btn-add" style="text-decoration: none;">Add to Cart</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found. Please run the database seeder.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; <?= date('Y') ?> Nexus Store. All rights reserved. Designed for the elite.</p>
    </footer>

</body>
</html>
