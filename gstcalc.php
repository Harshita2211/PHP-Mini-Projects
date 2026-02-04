<?php declare(strict_types=1);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GST Calculator</title>
</head>
<style>
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, sans-serif;
}

body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #43cea2, #185a9d);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.box {
    background: #ffffff;
    width: 100%;
    max-width: 420px;
    padding: 25px 30px;
    border-radius: 14px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.2);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

input {
    padding: 12px 14px;
    font-size: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    transition: border 0.3s, box-shadow 0.3s;
}

input:focus {
    border-color: #43cea2;
    box-shadow: 0 0 0 3px rgba(67,206,162,0.25);
}

button {
    margin-top: 10px;
    padding: 12px;
    font-size: 15px;
    border: none;
    border-radius: 8px;
    background: #43cea2;
    color: white;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}

button:hover {
    background: #36b896;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

h2 {
    margin-top: 22px;
    color: #333;
}

p {
    margin: 6px 0;
    color: #444;
    font-size: 15px;
}
</style>

<body>
    <div class="box">
        <h1>GST Calculator</h1>
        <form method="POST">
            <input type="number" step="0.01" name="amount" placeholder="Enter Amount" required value="<?= htmlspecialchars($_POST['amount'] ?? '') ?>">
            <input type="number" step="0.01" name="gst_rate" placeholder="Enter GST Rate (%)" required value="<?= htmlspecialchars($_POST['gst_rate'] ?? '') ?>">
            <button type="submit">Calculate GST</button>
        </form>
        <?php
        function calculate_gst(float $amount, float $gst_rate): array {
            $gst_amount = ($amount * $gst_rate) / 100;
            $total_amount = $amount + $gst_amount;
            return [
                'gst_amount' =>  $gst_amount, 
                'total_amount' => $total_amount, 
                'rate' => $gst_rate
            ];
        }
        if (isset($_POST['amount']) && isset($_POST['gst_rate'])) {
            $amount = (float)$_POST['amount'];
            $gst_rate = (float)$_POST['gst_rate'];
            $result = calculate_gst($amount, $gst_rate);
            echo "<h2>Calculation Result:</h2>";
            echo "<p>Original Amount: ₹" . number_format($amount, 2) . "</p>";
            echo "<p>GST Rate: " . $result['rate'] . "%</p>";

            echo "<p>GST Amount: ₹" . number_format($result['gst_amount'], 2) . "</p>";
            echo "<p>Total Amount (Including GST): ₹" . number_format($result['total_amount'], 2) . "</p>";
        }
        ?>
    </div>
</body>
</html>