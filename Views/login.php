<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Sign In') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        .auth-container {
            max-width: 400px;
            margin: 5rem auto;
            background: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
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
        .form-control:focus {
            outline: none;
            border-color: var(--accent-neon);
        }
        .error-message {
            color: #ff4757;
            background: rgba(255, 71, 87, 0.1);
            padding: 0.8rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="<?= BASE_URL ?>/index.php" class="brand-logo">NEXUS <span>.</span></a>
    </header>

    <main class="container">
        <div class="auth-container">
            <h2 style="text-align: center; margin-bottom: 2rem;">Sign In</h2>
            
            <?php if (isset($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/index.php/auth/login" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Authenticate</button>
            </form>
            
            <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
                Testing? Use the database seeder to create an admin user.
            </p>
        </div>
    </main>
</body>
</html>
