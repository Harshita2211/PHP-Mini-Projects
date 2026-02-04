<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);  
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: gradientShift 15s ease infinite;
            background-size: 400% 400%;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }
        
        .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 40px rgba(102, 126, 234, 0.4);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2), 0 0 60px rgba(102, 126, 234, 0.3);
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .card:hover::before {
            left: 100%;
        }
        
        h2.day {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            letter-spacing: 2px;
            animation: slideDown 0.6s ease-out;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .emoji {
            font-size: 120px;
            margin: 30px 0;
            display: block;
            animation: bounce 2s ease-in-out infinite;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        p {
            font-size: 22px;
            font-weight: 700;
            color: white;
            margin: 25px 0;
            letter-spacing: 1px;
            animation: fadeInUp 0.7s ease-out 0.2s both;
            padding: 15px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        small {
            font-size: 14px;
            color: white;
            display: block;
            margin-top: 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
            animation: fadeInUp 0.7s ease-out 0.4s both;
            opacity: 0.9;
        }
    </style>
    <title>What kind of day Is it?</title>
</head>
<body>
    <div class="card">
        <?php
        $dayNumber = (int)date('w'); // 0 (for Sunday) through 6 (for Saturday)
        $dayName = match($dayNumber) {
            0 => ['name' => 'Sunday', 'emoji' => '🌞'],
            1 => ['name' => 'Monday', 'emoji' => '😐'],
            2 => ['name' => 'Tuesday', 'emoji' => '🙂'],
            3 => ['name' => 'Wednesday', 'emoji' => '😌'],
            4 => ['name' => 'Thursday', 'emoji' => '😃'],
            5 => ['name' => 'Friday', 'emoji' => '🎉'],
            6 => ['name' => 'Saturday', 'emoji' => '😎'],
            default => ['name' => 'Unknown', 'emoji' => '❓'],
        };
        $vibe = match($dayNumber) {
            0,6 => 'Relaxed',
            1,2 => 'Productive',
            3,4 => 'Energetic',
            5 => 'Excited',
            default => 'Neutral',
        };
        $emoji = match($vibe) {
            'Relaxed' => '🌴',
            'Productive' => '💼',
            'Energetic' => '⚡',
            'Excited' => '🎊',
            default => '🙂',
        };
        echo "<h2 class='day'>{$dayName['name']}</h2>";
        echo "<div class='emoji'>$emoji</div>";
        echo "<p>$vibe</p>";
        echo "<small>Today is {$dayName['name']}</small>";
        ?>
    </div>
</body>
</html>