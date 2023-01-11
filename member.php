<?php
require __DIR__ . "/inc/header.php"; 
if (!isset($_SESSION['user']))
{
    header('Location: login.php?errmsg=' . 'You need to login.');
    exit;
}
?>



<h1>Welcome <?= htmlspecialchars($_SESSION['user']['firstname'] ?? 'Member') ?></h1>

<?php require __DIR__ . "/inc/footer.php"; ?>