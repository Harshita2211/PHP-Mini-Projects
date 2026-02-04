<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Fascinating single-column product list */
        :root{
            --page-bg: linear-gradient(180deg,#f7fbfd,#eef7f9);
            --card-bg: #ffffff;
            --muted: #6b7280;
            --accent: #0ea5a4; /* teal */
            --accent-weak: rgba(14,165,164,0.09);
            --accent-strong: #036b63;
            --border: rgba(2,6,23,0.06);
            --radius: 14px;
        }
        html,body{height:100%;}
        body{
            margin:0;
            padding:36px 20px;
            font-family: "Segoe UI", Inter, Roboto, Arial, sans-serif;
            background: var(--page-bg);
            color: #0f172a;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }
        h1{ text-align:center; margin:0 0 22px; font-size:28px; letter-spacing:0.2px; color:#022b2a }

        /* Force single-column layout so one box appears per line */
        .products{
            display:grid;
            grid-template-columns: 1fr;
            gap:18px;
            max-width:820px;
            margin:0 auto;
            padding:8px;
        }

        /* Card with left accent bar and subtle motion */
        .product{
            position:relative;
            display:flex;
            align-items:center;
            gap:18px;
            padding:18px 20px 18px 22px;
            background: linear-gradient(180deg,var(--card-bg),#fbfeff);
            border-radius:var(--radius);
            border: 1px solid var(--border);
            box-shadow: 0 12px 32px rgba(2,6,23,0.06);
            transition: transform .22s cubic-bezier(.2,.9,.25,1), box-shadow .22s ease;
            overflow:hidden;
        }
        .product::before{
            content:"";
            position:absolute;
            left:0; top:0; bottom:0;
            width:6px;
            border-radius:var(--radius) 0 0 var(--radius);
            background: linear-gradient(180deg,var(--accent),var(--accent-strong));
            transform-origin:left;
            transition: width .18s ease;
        }
        .product:hover{ transform: translateY(-8px) scale(1.01); box-shadow: 0 24px 48px rgba(2,6,23,0.09);} 
        .product:hover::before{ width:10px }
        .product:focus-within{ outline: 3px solid rgba(14,165,164,0.12); outline-offset:6px }

        /* Image: rounded, floating */
        .image{
            width:80px; height:80px; border-radius:16px;
            display:flex; align-items:center; justify-content:center;
            font-size:40px; background: linear-gradient(180deg,#ffffff,#f0f9f8);
            box-shadow: 0 6px 18px rgba(2,6,23,0.06), inset 0 1px 0 rgba(255,255,255,0.6);
            flex:0 0 80px;
            line-height:1;
        }

        /* Content */
        .info{ flex:1; min-width:0; display:flex; flex-direction:column }
        .product-name{ margin:0 0 6px; font-size:18px; font-weight:700; color:#052b2a; overflow:hidden; text-overflow:ellipsis; white-space:nowrap }
        .product-price{ margin:0; color:var(--muted); font-weight:600; font-size:13px; text-decoration: line-through; opacity:0.9 }
        .product-discounted-price{ margin:8px 0 0; color:#ffffff; font-weight:700; font-size:14px; display:inline-block; background:linear-gradient(90deg,var(--accent),var(--accent-strong)); padding:8px 12px; border-radius:999px; box-shadow: 0 6px 18px rgba(14,165,164,0.12) }

        /* Optional small description */
        .product .desc{ margin:8px 0 0; color:var(--muted); font-size:13px; line-height:1.3; max-height:48px; overflow:hidden; text-overflow:ellipsis }

        /* Tweak for small screens */
        @media (max-width:640px){
            body{ padding:18px 14px }
            .products{ max-width:100%; gap:12px }
            .product{ padding:12px 12px 12px 14px; gap:12px }
            .image{ width:60px; height:60px; font-size:30px }
            .product-name{ font-size:16px }
            .product-discounted-price{ padding:6px 8px; font-size:13px }
        }

n    </style>
    <title>Product List</title>
</head>
<body>
    <h1>Dynamic Product List</h1>
    <div class="products">
    <?php
    // Sample array of products with name and price
    $products = [
        ['name' => 'Laptop Stand',
        'price' => 39.99,
        'desc' => 'Ergonomic aluminum laptop stand.',
        'image' => '💻'
        ],
        ['name' => 'Bluetooth Headphones',
        'price' => 79.99,
        'desc' => 'Wireless noise-canceling headphones.',
        'image' => '🎧'
        ],
        ['name' => 'Smartphone Holder', 
        'price' => 19.99,
        'desc' => 'Adjustable holder for smartphones.',
        'image' => '📱'
        ],
        ['name' => 'USB-C Hub', 
        'price' => 49.99,
        'desc' => 'Multiport adapter with HDMI and USB ports.',
        'image' => '🔌'
        ],
        ['name' => 'Portable Charger',
        'price' => 29.99,
        'desc' => 'Fast-charging portable battery pack.',
        'image' => '🔋'
        ]
    ];
    // Loop through the products array and display each product
    foreach ($products as $product) :   
        $discountedPrice = $product['price'] * 0.9; // 10% discount
    
    ?>
    <div class="product">
        <div class="image"><?= $product ['image']?></div>
        <div class = "info">
            <h2 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h2>
            <p class="product-price">Price: $<?php echo number_format($product['price'], 2); ?></p>
            <p class="product-discounted-price">Discounted Price: $<?php echo number_format($discountedPrice, 2); ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>