<html>

<head>
    <title>Tutorial Login dan Register</title>
</head>

<body>
    <?php $session = session() ?>
    <h4>Selamat Datang User!</h4>
    <?php echo $session->get('username') ?>
    <a href="/auth/logout">Logout
    </a>
</body>

</html>