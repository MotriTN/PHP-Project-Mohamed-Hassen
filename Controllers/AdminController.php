<?php

declare(strict_types=1);

class AdminController extends BaseController
{
    private ProductManager $productManager;

    public function __construct()
    {
        // Enforce Authentication
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            // Redirect non-admins to login
            $this->redirect('/projet2/Public/index.php/auth/login');
        }

        $this->productManager = new ProductManager();
    }

    /**
     * Dashboard / List all products
     */
    public function index(): void
    {
        $products = $this->productManager->getAll();
        $this->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'products' => $products
        ]);
    }

    /**
     * Show form to create product
     */
    public function create(): void
    {
        $this->render('admin/product_form', [
            'title' => 'Add New Product',
            'product' => new Product() // Empty product for the form
        ]);
    }

    /**
     * Handle POST request to save new product
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Product();
            $product->setName($_POST['name'] ?? '');
            $product->setDescription($_POST['description'] ?? '');
            $product->setPrice((float)($_POST['price'] ?? 0));
            $product->setStock((int)($_POST['stock'] ?? 0));

            // Handle Image Upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                try {
                    $uploader = new Uploader();
                    $imagePath = $uploader->upload($_FILES['image']);
                    $product->setImageUrl($imagePath);
                } catch (Exception $e) {
                    die("Upload Error: " . $e->getMessage());
                }
            }

            $this->productManager->create($product);
            $this->redirect('/projet2/Public/index.php/admin/index');
        }
    }

    /**
     * Show form to edit product
     */
    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->productManager->getById($id);

        if (!$product) {
            die("Product not found.");
        }

        $this->render('admin/product_form', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    /**
     * Handle POST request to update product
     */
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $product = $this->productManager->getById($id);
            
            if (!$product) die("Product not found");

            $product->setName($_POST['name'] ?? '');
            $product->setDescription($_POST['description'] ?? '');
            $product->setPrice((float)($_POST['price'] ?? 0));
            $product->setStock((int)($_POST['stock'] ?? 0));

            // Handle Image Upload if a new one is provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                try {
                    $uploader = new Uploader();
                    $imagePath = $uploader->upload($_FILES['image']);
                    $product->setImageUrl($imagePath);
                } catch (Exception $e) {
                    die("Upload Error: " . $e->getMessage());
                }
            }

            $this->productManager->update($product);
            $this->redirect('/projet2/Public/index.php/admin/index');
        }
    }

    /**
     * Handle deletion of product
     */
    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->productManager->delete($id);
        }
        $this->redirect('/projet2/Public/index.php/admin/index');
    }
}
