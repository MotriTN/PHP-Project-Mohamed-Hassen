<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Product Form') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            background: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; color: var(--text-muted); }
        .form-control {
            width: 100%;
            padding: 0.8rem;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-main);
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="<?= BASE_URL ?>/index.php/admin/index" class="brand-logo">NEXUS <span>ADMIN</span></a>
    </header>

    <main class="container">
        <div class="form-container">
            <h2 style="margin-bottom: 2rem;"><?= htmlspecialchars($title) ?></h2>
            
            <?php $isEdit = $product->getId() !== null; ?>
            
            <form action="<?= BASE_URL ?>/index.php/admin/<?= $isEdit ? 'update' : 'store' ?>" method="POST" enctype="multipart/form-data">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?= $product->getId() ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product->getName() ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($product->getDescription() ?? '') ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Price (TND)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars((string)($product->getPrice() ?? '')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars((string)($product->getStock() ?? '')) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Image (Leave blank to keep current)</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/webp">
                    <?php if ($product->getImageUrl()): ?>
                        <p style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--text-muted);">Current: <?= htmlspecialchars(basename($product->getImageUrl())) ?></p>
                    <?php endif; ?>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Save Product</button>
                    <a href="<?= BASE_URL ?>/index.php/admin/index" class="btn" style="flex: 1; text-align: center; border: 1px solid var(--text-muted); color: var(--text-muted);">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
