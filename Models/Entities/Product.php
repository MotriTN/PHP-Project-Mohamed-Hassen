<?php

declare(strict_types=1);

class Product
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?float $price = null;
    private ?string $image_url = null;
    private ?int $stock = 0;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function getDescription(): ?string { return $this->description; }
    public function getPrice(): ?float { return $this->price; }
    public function getImageUrl(): ?string { return $this->image_url; }
    public function getStock(): ?int { return $this->stock; }
    public function getCreatedAt(): ?string { return $this->created_at; }
    public function getUpdatedAt(): ?string { return $this->updated_at; }

    // Setters (fluent interface)
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setPrice(float $price): self { $this->price = $price; return $this; }
    public function setImageUrl(?string $image_url): self { $this->image_url = $image_url; return $this; }
    public function setStock(int $stock): self { $this->stock = $stock; return $this; }
    public function setCreatedAt(string $created_at): self { $this->created_at = $created_at; return $this; }
    public function setUpdatedAt(string $updated_at): self { $this->updated_at = $updated_at; return $this; }
}
