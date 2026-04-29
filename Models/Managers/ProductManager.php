<?php

declare(strict_types=1);

class ProductManager
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Retrieve all products from the database.
     *
     * @return Product[]
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
        $results = $stmt->fetchAll();
        
        $products = [];
        foreach ($results as $row) {
            $products[] = $this->hydrate($row);
        }
        
        return $products;
    }

    /**
     * Retrieve a product by ID.
     *
     * @param int $id
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        
        if ($row) {
            return $this->hydrate($row);
        }
        
        return null;
    }

    /**
     * Create a new product.
     *
     * @param Product $product
     * @return bool
     */
    public function create(Product $product): bool
    {
        $sql = "INSERT INTO products (name, description, price, image_url, stock) 
                VALUES (:name, :description, :price, :image_url, :stock)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'image_url' => $product->getImageUrl(),
            'stock' => $product->getStock()
        ]);
    }

    /**
     * Update an existing product.
     *
     * @param Product $product
     * @return bool
     */
    public function update(Product $product): bool
    {
        $sql = "UPDATE products SET 
                    name = :name, 
                    description = :description, 
                    price = :price, 
                    image_url = :image_url, 
                    stock = :stock 
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'image_url' => $product->getImageUrl(),
            'stock' => $product->getStock()
        ]);
    }

    /**
     * Delete a product by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Hydrate a Product entity from an array of data.
     *
     * @param array $data
     * @return Product
     */
    private function hydrate(array $data): Product
    {
        $product = new Product();
        
        if (isset($data['id'])) $product->setId((int)$data['id']);
        if (isset($data['name'])) $product->setName($data['name']);
        if (isset($data['description'])) $product->setDescription($data['description']);
        if (isset($data['price'])) $product->setPrice((float)$data['price']);
        if (isset($data['image_url'])) $product->setImageUrl($data['image_url']);
        if (isset($data['stock'])) $product->setStock((int)$data['stock']);
        if (isset($data['created_at'])) $product->setCreatedAt($data['created_at']);
        if (isset($data['updated_at'])) $product->setUpdatedAt($data['updated_at']);
        
        return $product;
    }
}
