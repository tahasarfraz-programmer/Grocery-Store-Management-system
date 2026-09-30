<?php
require_once __DIR__ . '/../config.php';
function logo(){ return '<svg class="logo" viewBox="0 0 250 44" height="36" role="img" aria-label="'.APP.'"><g fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h5l4 19h17l4-14H10"/><circle cx="16" cy="35" r="2.6"/><circle cx="28" cy="35" r="2.6"/></g><path d="M30 3c6 0 9 3 9 8-6 0-9-3-9-8z" fill="#a3e635"/><text x="50" y="21" class="w1">Grocery Store</text><text x="50" y="39" class="w2">Management system</text></svg>'; }
function top($title, $app = true){
  $p = basename($_SERVER['PHP_SELF']); ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($title) ?> · <?= APP ?></title>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css"></head><body class="<?= $app ? 'app' : 'pub' ?>">
<div class="curtain"></div>
<?php if ($app): auth(); ?>
<aside><a href="dashboard.php"><?= logo() ?></a>
<nav><?php foreach (['dashboard.php'=>'Dashboard','products.php'=>'Products','pos.php'=>'Billing'] as $f=>$l): ?>
<a href="<?= $f ?>" class="<?= $p==$f?'on':'' ?>"><?= $l ?></a><?php endforeach; ?></nav>
<div class="who"><?= e($_SESSION['u']['name']) ?><a href="logout.php">Log out</a></div></aside><main>
<?php endif;
}
function bottom(){ ?></main><script src="assets/js/app.js"></script></body></html><?php }
