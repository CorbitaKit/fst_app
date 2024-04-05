<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .pricing {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .plan {
            padding: 20px;
            margin: 0 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .plan:nth-child(1) {
            background-color: #609487;
            color: #fff;
        }

        .plan:nth-child(2) {
            background-color: #02A9BF;
            color: #fff;
        }

        .plan h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .plan p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sign Up</h1>
        <div class="pricing">
            <div class="plan">
                <h2>Basic</h2>
                <p>$10/month</p>
                <a href="#" class="button">Sign Up</a>
            </div>
            <div class="plan">
                <h2>Premium</h2>
                <p>$20/month</p>
                <a href="#" class="button">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>