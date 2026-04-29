<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nexus - Premium Digital Gear. High-performance peripherals for elite gamers and creators.">
    <title><?= htmlspecialchars($title ?? 'Nexus Store') ?></title>
    <!-- Use relative path from the perspective of the browser hitting index.php -->
    <link rel="stylesheet" href="/projet2/Public/assets/css/style.css">
</head>
<body>

    <header class="site-header">
        <a href="/projet2/Public/index.php" class="brand-logo">
            NEXUS <span>.</span>
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Shop</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Sign In</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Upgrade Your <span>Reality</span></h1>
            <p>Discover our curated collection of elite digital gear. Engineered for performance, designed for aesthetics.</p>
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
                                    <button class="btn-add">Add to Cart</button>
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
