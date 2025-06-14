<?php

declare(strict_types=1); //Pour forcer le respect des types

class Product
{
    private int $id_products;
    private string $name;
    private DateTime $creation_date;
    private float $price_ttc;
    private float $price_kg;
    private string $description;
    private string $advice_info;
    private string $quality_label;
    private string $composition;
    private bool $in_stock;
    private bool $is_active;
    private ?string $image_url = null;
    private ?string $alt_text = null;
    private ?string $id_images = null;

    // Setters
    public function setIdProducts(int $id_products): void
    {
        $this->id_products = $id_products;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCreationDate(DateTime $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function setPriceTtc(float $price_ttc): void
    {
        $this->price_ttc = $price_ttc;
    }

    public function setPriceKg(float $price_kg): void
    {
        $this->price_kg = $price_kg;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setAdviceInfo(string $advice_info): void
    {
        $this->advice_info = $advice_info;
    }

    public function setQualityLabel(string $quality_label): void
    {
        $this->quality_label = $quality_label;
    }

    public function setComposition(string $composition): void
    {
        $this->composition = $composition;
    }

    public function setInStock(bool $in_stock): void
    {
        $this->in_stock = $in_stock;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function setImageUrl(?string $image_url): void
    {
    $this->image_url = $image_url;
    }

    public function setAltText(?string $alt_text): void
    {
    $this->alt_text = $alt_text;
    }

    public function setIdImages(?string $id_images): void
    {
    $this->id_images = $id_images;
    }

    // Getters
    public function getIdProducts(): int
    {
        return $this->id_products;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    public function getPriceTtc(): float
    {
        return $this->price_ttc;
    }

    public function getPriceKg(): float
    {
        return $this->price_kg;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdviceInfo(): string
    {
        return $this->advice_info;
    }

    public function getQualityLabel(): string
    {
        return $this->quality_label;
    }

    public function getComposition(): string
    {
        return $this->composition;
    }

    public function getInStock(): bool
    {
        return $this->in_stock;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }
    public function getImageUrl(): ?string
    {
    return $this->image_url;
    }
    
    public function getAltText(): ?string
    {
    return $this->alt_text;
    }

    public function getIdImages(): ?string
    {
    return $this->id_images;
    }
}


class ProductsRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getProduct(int $identifier): Product
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM products WHERE id_products = ?"
        );
        $statement->execute([$identifier]); // A ce stade, $statement contient les résultats de la requête sous forme brute.

        $row = $statement->fetch(PDO::FETCH_ASSOC); // Utilise FETCH_ASSOC pour obtenir uniquement les colonnes avec leurs noms comme clés (pas d'index numériques)

        if (!$row) {
            throw new \Exception("Produit non trouvé");
        }

        $product = new Product();
        $product->setIdProducts((int)$row['id_products']);
        $product->setName($row['name']);
        $product->setCreationDate(new DateTime($row['creation_date']));
        $product->setPriceTtc((float)$row['price_ttc']);
        $product->setPriceKg((float)$row['price_kg']);
        $product->setDescription($row['description']);
        $product->setAdviceInfo($row['advice_info']);
        $product->setQualityLabel($row['quality_label']);
        $product->setComposition($row['composition']);
        $product->setInStock((bool)$row['in_stock']);
        $product->setIsActive((bool)$row['is_active']);

        return $product;
    }



    public function getProductsWithImages(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT p.id_products, p.name, p.description, i.id_images, i.image_url, i.alt_text 
            FROM products p 
            LEFT JOIN images i ON p.id_products = i.id_products"
        );
        $products = [];
        while (($row = $statement->fetch(PDO::FETCH_ASSOC))) {
            $product = new Product();
            $product->setIdProducts((int)$row['id_products']);
            $product->setName($row['name']);
            $product->setDescription($row['description']);
            $product->setImageUrl($row['image_url']);
            $product->setAltText($row['alt_text']);
            $product->setIdImages($row['id_images']);

            $products[] = $product;
        }
        

        return $products;
    }
    
}
