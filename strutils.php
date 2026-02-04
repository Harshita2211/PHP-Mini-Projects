<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, sans-serif;
}

body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.container {
    background: #ffffff;
    width: 100%;
    max-width: 650px;
    padding: 25px 30px;
    border-radius: 14px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.2);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

textarea {
    width: 100%;
    min-height: 120px;
    padding: 12px 14px;
    font-size: 16px;
    border-radius: 10px;
    border: 1px solid #ccc;
    resize: vertical;
    outline: none;
    transition: border 0.3s, box-shadow 0.3s;
}

textarea:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
    margin-top: 18px;
}

button {
    padding: 10px 12px;
    border: none;
    border-radius: 8px;
    background: #667eea;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}

button:hover {
    background: #5a67d8;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

.result {
    margin-top: 25px;
    padding: 18px;
    background: #f7f9ff;
    border-radius: 12px;
    border-left: 5px solid #667eea;
}

.result h2 {
    margin: 10px 0;
    word-break: break-word;
    color: #444;
}

.result small {
    color: #666;
}

    </style>
    <title>String Utils</title>
</head>
<body>
    <div class="container">
        <h1>String Utility Tools</h1>
        <form method = "POST">
            <textarea name="text" placeholder="Type anything.. emojis allowed!" required><?= htmlspecialchars($_POST['text'] ?? '') ?></textarea>

            <div class="grid">
                <button name="do" value="upper">Uppercase</button>
                <button name="do" value="lower">Lowercase</button>
                <button name="do" value="title">Title Case</button>
                <button name="do" value="trim">Trim Whitespace</button>
                <button name="do" value="reverse">String Reverse</button>
                <button name="do" value="count">String Count only</button>
    </div>
    </form>
    <?php
    if(isset($_POST['text'])){
        $t = $_POST['text'];
        $result = $t;

        match($_POST['do']){
            'upper' => $result = mb_strtoupper($t),
            'lower' => $result = mb_strtolower($t),
            'title' => $result = ucwords(strtolower($t)),
            'trim' => $result = trim($t),
            'reverse' => $result = strrev($t),
            'count' => $result = "Character Count: " . mb_strlen($t)."characters",
        };
        echo "<div class='result'>";
        echo "<strong>Result:</strong><br>";
        echo "<h2>" . htmlspecialchars($result) . "</h2>";
        echo "<small>Original Length: " . mb_strlen($t) . " characters</small>";
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>