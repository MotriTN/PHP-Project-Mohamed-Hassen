<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Admin Dashboard') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: var(--bg-card);
        }
        .admin-table th, .admin-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .admin-table th { color: var(--accent-neon); }
        .action-btn { margin-right: 0.5rem; color: var(--text-main); text-decoration: none; font-size: 0.9rem; }
        .action-btn:hover { color: var(--accent-neon); }
        .action-delete:hover { color: #ff4757; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.9rem; }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="<?= BASE_URL ?>/index.php" class="brand-logo">NEXUS <span>ADMIN</span></a>
        <nav>
            <ul class="nav-links">
                <li><a href="<?= BASE_URL ?>/index.php">View Store</a></li>
                <li><a href="<?= BASE_URL ?>/index.php/auth/logout">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Product Management</h2>
            <a href="<?= BASE_URL ?>/index.php/admin/create" class="btn btn-primary btn-sm">+ Add Product</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->getId() ?></td>
                    <td>
                        <?php if ($product->getImageUrl()): ?>
                            <img src="<?= htmlspecialchars($product->getImageUrl()) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <div style="width: 50px; height: 50px; background: #333; border-radius: 4px;"></div>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($product->getName()) ?></td>
                    <td><?= number_format($product->getPrice(), 2) ?> TND</td>
                    <td><?= $product->getStock() ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/index.php/admin/edit?id=<?= $product->getId() ?>" class="action-btn">Edit</a>
                        <a href="<?= BASE_URL ?>/index.php/admin/delete?id=<?= $product->getId() ?>" class="action-btn action-delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
