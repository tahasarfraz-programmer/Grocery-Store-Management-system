<?php require 'includes/layout.php'; auth();
if ($_SERVER['REQUEST_METHOD']=='POST') { header('Content-Type: application/json'); $d = json_decode(file_get_contents('php://input'), true);
  try { $pdo->beginTransaction(); $t = 0; $it = [];
    foreach ($d['items'] as $i) { $s = $pdo->prepare('SELECT price,stock,name FROM products WHERE id=? FOR UPDATE'); $s->execute([$i['id']]); $p = $s->fetch(); $n = (int)$i['qty'];
      if (!$p || $n < 1 || $p['stock'] < $n) throw new Exception('Not enough stock for '.($p['name'] ?? 'item')); $t += $p['price']*$n; $it[] = [$i['id'],$n,$p['price']]; }
    $pdo->prepare('INSERT INTO sales(user_id,customer,total) VALUES(?,?,?)')->execute([$_SESSION['u']['id'],$d['customer'],$t]); $sid = $pdo->lastInsertId();
    foreach ($it as $x) { $pdo->prepare('INSERT INTO sale_items(sale_id,product_id,qty,price) VALUES(?,?,?,?)')->execute([$sid,...$x]); $pdo->prepare('UPDATE products SET stock=stock-? WHERE id=?')->execute([$x[1],$x[0]]); }
    $pdo->commit(); echo json_encode(['ok'=>1,'id'=>$sid,'total'=>$t]);
  } catch (Exception $x) { $pdo->rollBack(); echo json_encode(['ok'=>0,'msg'=>$x->getMessage()]); } exit; }
$prods = $pdo->query('SELECT id,name,price,stock FROM products WHERE stock>0 ORDER BY name')->fetchAll();
top('Billing'); ?>
<h1>Billing</h1><div class="pos"><div><input id="find" placeholder="Search products" autofocus><div id="grid" class="grid"></div></div>
<div class="card cart"><h3>Current bill</h3><input id="cust" placeholder="Customer name (optional)"><div id="lines"></div><p class="row total">Total <b id="tot">0.00</b></p><button id="pay" class="btn big">Complete sale</button><p id="msg"></p></div></div>
<script>const PRODUCTS=<?= json_encode($prods) ?>;</script><?php bottom();
