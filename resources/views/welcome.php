<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyper Php - Sweet and MVC Based PHP Tiny Web Framework</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #c9d1d9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 768px;
            padding: 30px;
            background-color: #161b22;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            border-radius: 6px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 2.25rem;
            color: #ff7b00;
            font-weight: 700;
        }

        p {
            font-size: 1rem;
            line-height: 1.8;
            color: #b3b3b3;
            margin: 15px 0;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, #ff7b00, #ff4d00);
            border-radius: 6px;
            transition: transform 0.2s ease-in-out;
        }

        a:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Hyper Php</h1>
        <p>Hyper Php is a sweet and MVC (Model-View-Controller) based PHP tiny web framework designed to make web
            development faster and easier. Whether you're building a small project or a large application, Hyper Php
            provides a lightweight, flexible, and powerful foundation to get you started quickly.</p>
        <p>Explore the features, check out the documentation, and start building amazing web applications <br /> with
            <b>Hyper Php</b> today!
        </p>
        <a href="https://github.com/vulcanphp/hyper" target="_blank">View on GitHub</a>
    </div>
</body>

</html>