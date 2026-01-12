<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Recad Vera Cruz-BA</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!-- STYLES -->
    <style {csp-style-nonce}>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        a {
            display: flex;
            padding: 10px 14px;
            background-color: greenyellow;
            color: black;
            text-decoration: none;
            font-size: 22px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <br>
    <br>
    <a href="<?=base_url(relativePath: "login")?>">Login</a>
    <br>
    <br>
    <a href="<?=base_url(relativePath: "register")?>">registro</a>
    <a href="<?=base_url('logout') ?>" class="text-red-600 hover:underline">Sair</a>
    
</body>

</html>