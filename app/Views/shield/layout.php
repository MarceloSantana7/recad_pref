<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->renderSection('title') ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=base_url('css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/font.css')?>">
    <?= $this->renderSection('pageStyles') ?>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <?= $this->renderSection('main') ?>
    </div>
    <?= $this->renderSection('pageScripts') ?>
</body>
</html>
