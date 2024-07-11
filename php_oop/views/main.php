<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body,
        h1,
        h2,
        h3,
        p,
        ul,
        li,
        form,
        label {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        header,
        nav,
        main,
        footer {
            text-align: center;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 40px;
        }

        button {
            background: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background: #555;
        }

        .service {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            display: inline-block;
            width: 30%;
            box-sizing: border-box;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form label {
            margin: 10px 0 5px;
        }

        form input,
        form textarea {
            padding: 10px;
            width: 80%;
            margin-bottom: 10px;
        }

        footer {
            background: #333;
            color: #fff;
            padding: 10px 0;
        }

        @media (max-width: 768px) {
            .service {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    {{content}}
    <footer>
        <p>&copy; 2024 Company Name. All rights reserved.</p>
    </footer>

</body>

</html>