<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Calculator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .calculator {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .result {
            margin-top: 25px;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .result h2 {
            color: #667eea;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .result p {
            color: #333;
            font-size: 32px;
            font-weight: 700;
            word-break: break-all;
        }

        .error {
            color: #e74c3c;
            padding: 15px;
            background: #fadbd8;
            border-left: 4px solid #e74c3c;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 500;
        }

        .success {
            color: #27ae60;
            padding: 15px;
            background: #d5f4e6;
            border-left: 4px solid #27ae60;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .calculator {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .result p {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>Mini Calculator</h1>
        <form method="post">
            <input type = "number" name = "num1" placeholder="Enter first number" required step="any">
            <input type = "number" name = "num2" placeholder="Enter second number" required step="any">
            <select name="operation" required>
                <option value="" disabled selected>Select operation</option>
                <option value="add">Addition (+)</option>
                <option value="subtract">Subtraction (-)</option>
                <option value="multiply">Multiplication (×)</option>
                <option value="divide">Division (÷)</option>
                <option value="modulus">Modulus (%)</option>
                <option value="exponentiation">Exponentiation (^)</option>
        
        </select>
        <button type = "submit">Calculate</button>
        </form>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num1 = (float)$_POST['num1'];
            $num2 = (float)$_POST['num2'];
            $operation = $_POST['operation'];
            $result = null;
            $error = null;

            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    if ($num2 == 0) {
                        $error = "Error: Division by zero is not allowed.";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                case 'modulus':
                    if ($num2 == 0) {
                        $error = "Error: Modulus by zero is not allowed.";
                    } else {
                        $result = $num1 % $num2;
                    }
                    break;
                case 'exponentiation':
                    $result = $num1 ** $num2;
                    break;
                default:
                    $error = "Invalid operation.";
            }

            if ($error) {
                echo '<div class="error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</div>';
            } else {
                echo '<div class="result">';
                echo '<h2>Result</h2>';
                echo '<p>' . htmlspecialchars((string)$result, ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>