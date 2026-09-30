<?php require 'includes/layout.php'; top('Dashboard');
$q = fn($sql) => $pdo->query($sql)->fetch()['v'];
$stats = ['Products'=>$q('SELECT COUNT(*) v FROM products'),'Low stock'=>$q('SELECT COUNT(*) v FROM products WHERE stock<=min_stock'),
 "Today's sales"=>$q('SELECT COALESCE(SUM(total),0) v FROM sales WHERE DATE(created_at)=CURDATE()'),'All-time revenue'=>$q('SELECT COALESCE(SUM(total),0) v FROM sales')];
$low = $pdo->query('SELECT name,stock,min_stock FROM products WHERE stock<=min_stock ORDER BY stock LIMIT 6')->fetchAll();
$rec = $pdo->query('SELECT id,customer,total,created_at FROM sales ORDER BY id DESC LIMIT 6')->fetchAll(); ?>
<h1>Dashboard</h1><div class="stats"><?php foreach ($stats as $k=>$v): ?>
<div class="stat <?= $k=='Low stock'&&$v?'warn':'' ?>"><span class="count" data-to="<?= $v ?>"><?= $v ?></span><small><?= $k ?></small></div><?php endforeach; ?></div>
<div class="two"><div class="card"><h3>Needs restocking</h3><?php foreach ($low as $r): ?>
<p class="row"><?= e($r['name']) ?><b class="tag"><?= $r['stock'] ?> left</b></p><?php endforeach; if (!$low) echo '<p>Every shelf is stocked.</p>'; ?></div>
<div class="card"><h3>Recent sales</h3><?php foreach ($rec as $r): ?>
<p class="row">#<?= $r['id'] ?> <?= e($r['customer'] ?: 'Walk-in') ?><b><?= number_format($r['total'],2) ?></b></p><?php endforeach; if (!$rec) echo '<p>No sales yet. Open Billing to ring up the first one.</p>'; ?></div></div>
<?php bottom();
