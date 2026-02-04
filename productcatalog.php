<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Array-Powered Store</title>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 20px;
        background: linear-gradient(135deg, #f4f4f4, #e9eef3);
        color: #333;
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 2.2rem;
    }

    /* Filters */
    .filters {
        background: #ffffff;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }

    .filters form {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        align-items: center;
    }

    .filters select,
    .filters input,
    .filters button {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .filters button {
        background: #4f46e5;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .filters button:hover {
        background: #3730a3;
    }

    /* Product Grid */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    /* Product Card */
    /* Card layout */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.12);
}

/* Image box */
.img {
    background: #f1f5f9;
    border-radius: 10px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 38px;
    margin-bottom: 14px;
    filter: grayscale(100%);
    opacity: 0.85;
}

/* Product info */
.info {
    text-align: center;
}

.name {
    font-size: 1.15rem;
    font-weight: 600;
    margin-bottom: 6px;
}

/* Category - BLUE */
.category {
    font-size: 0.9rem;
    font-weight: 600;
    color: #2563eb; /* blue */
    margin-bottom: 6px;
}

/* Price */
.price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #10b981;
    margin-bottom: 4px;
}

/* Rating - ORANGE */
.rating {
    font-size: 0.9rem;
    font-weight: 600;
    color: #f59e0b; /* orange */
}


    /* Footer Count */
    p:last-of-type {
        text-align: center;
        margin-top: 25px;
        font-weight: 600;
        color: #374151;
    }
</style>

</head>
<body>
    <?php 
    $products = [
    [
        'id' => 1,
        'name' => 'Laptop',
        'price' => 999.99,
        'category' => 'Peripherals',
        'rating' => 4.6,
        'emoji' => '💻'
    ],
    [
        'id' => 2,
        'name' => 'Smartphone',
        'price' => 499.99,
        'category' => 'Accessories',
        'rating' => 4.4,
        'emoji' => '📱'
    ],
    [
        'id' => 3,
        'name' => 'Tablet',
        'price' => 299.99,
        'category' => 'Accessories',
        'rating' => 4.2,
        'emoji' => '📲'
    ],
    [
        'id' => 4,
        'name' => 'Headphones',
        'price' => 199.99,
        'category' => 'Audio',
        'rating' => 4.7,
        'emoji' => '🎧'
    ],
    [
        'id' => 5,
        'name' => 'Smartwatch',
        'price' => 149.99,
        'category' => 'Accessories',
        'rating' => 4.1,
        'emoji' => '⌚'
    ]
];

// Handle filtering
$sort = $_GET['sort'] ?? 'name';
$category = $_GET['category'] ?? 'all';
$minPrice = (float)($_GET['minPrice'] ?? 0);

// Filter the products
$filtered = array_filter($products, function($p) use ($category, $minPrice) {
return($category === 'all' || $p['category'] === $category) && $p['price'] >= $minPrice;
});

// Sort the products
usort($filtered, function($a, $b) use ($sort) {
    return match($sort) {
        'price_asc' => $a['price'] <=> $b['price'],
        'rating_desc' => $b['rating'] <=> $a['rating'],
        default => $a['name'] <=> $b['name'],
    };
});
?>
<h1>PHP Array - Powered Store</h1>
    <div class="filters">
        <form method = "GET">
            <select name = "category">
                <option value = "all" <?=  $category === 'all' ? 'selected' : '' ?>>All Categories</option>
                <option value = "Audio" <?= $category === 'Audio' ? 'selected' : '' ?>>Audio</option>
                <option value = "Peripherals" <?= $category === 'Peripherals' ? 'selected' : '' ?>>Peripherals</option>
                <option value = "Accessories" <?= $category === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
            </select>
            <select name = "sort">
                <option value = "name" <?= $sort === 'name' ? 'selected' : '' ?>>Sort by Name</option>
                <option value = "price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Sort by Price: Low to High</option>
                <option value = "rating_desc" <?= $sort === 'rating_desc' ? 'selected' : '' ?>>Sort by Rating: High to Low</option>
            </select>
            <input type = "number" name = "minPrice" placeholder = "Min Price" value = "<?= htmlspecialchars((string)$minPrice) ?>" step="0.01" min="0">
            <button type = "submit">Apply Filters</button>
        </form>
    </div>
    <div class = "grid">
    <?php foreach ($filtered as $product): ?>
        <div class = "card">
            <div class = "img"><?= $product['emoji'] ?></div>
            <div class = "info">
                <h2 class="name"><?= htmlspecialchars($product['name']) ?></h2>
                <p class="category"><?= htmlspecialchars($product['category']) ?></p>
                <p class="price">$<?= number_format($product['price'], 2) ?></p>
                <p class="rating">Rating: <?= number_format($product['rating'], 1) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <p>Total Products: <?= count($filtered) ?>/<?= count($products) ?></p>
</body>
</html>