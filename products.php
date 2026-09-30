<?php require 'includes/layout.php'; auth();
if ($_POST) { $a = $_POST['a'];
  if ($a=='add') $pdo->prepare('INSERT INTO products(name,category_id,price,stock,min_stock) VALUES(?,?,?,?,?)')->execute([$_POST['name'],$_POST['cat'],$_POST['price'],$_POST['stock'],$_POST['min']]);
  if ($a=='restock') $pdo->prepare('UPDATE products SET stock=stock+? WHERE id=?')->execute([(int)$_POST['n'],$_POST['id']]);
  if ($a=='del') try { $pdo->prepare('DELETE FROM products WHERE id=?')->execute([$_POST['id']]); } catch (Exception $x) {}
  header('Location: products.php'); exit; }
$cats = $pdo->query('SELECT * FROM categories')->fetchAll();
$s = $pdo->prepare('SELECT p.*,c.name cat FROM products p JOIN categories c ON c.id=p.category_id WHERE p.name LIKE ? AND (?=0 OR p.category_id=?) ORDER BY p.name');
$c = (int)($_GET['c'] ?? 0); $s->execute(['%'.($_GET['q'] ?? '').'%',$c,$c]); $rows = $s->fetchAll();
top('Products'); ?>
<h1>Products</h1>
<form class="filters"><input name="q" placeholder="Search products" value="<?= e($_GET['q'] ?? '') ?>"><select name="c" onchange="this.form.submit()"><option value="0">All categories</option>
<?php foreach ($cats as $k): ?><option value="<?= $k['id'] ?>" <?= $c==$k['id']?'selected':'' ?>><?= e($k['name']) ?></option><?php endforeach; ?></select><button class="btn">Search</button></form>
<form method="post" class="card add"><input type="hidden" name="a" value="add"><input name="name" placeholder="New product name" required>
<select name="cat"><?php foreach ($cats as $k) echo "<option value='{$k['id']}'>".e($k['name'])."</option>"; ?></select>
<input name="price" type="number" step="0.01" placeholder="Price" required><input name="stock" type="number" placeholder="Stock" required><input name="min" type="number" placeholder="Min stock" value="10"><button class="btn">Add product</button></form>
<div class="card scroll"><table><tr><th>Product<th>Category<th>Price<th>Stock<th></tr>
<?php foreach ($rows as $r): ?><tr><td><?= e($r['name']) ?><td><?= e($r['cat']) ?><td><?= number_format($r['price'],2) ?>
<td><b class="tag <?= $r['stock']<=$r['min_stock']?'low':'' ?>"><?= $r['stock'] ?></b>
<td class="act"><form method="post"><input type="hidden" name="a" value="restock"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="n" type="number" value="10" min="1"><button class="btn sm">Restock</button></form>
<form method="post" onsubmit="return confirm('Delete this product?')"><input type="hidden" name="a" value="del"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn sm ghost">Delete</button></form></tr>
<?php endforeach; if (!$rows) echo '<tr><td colspan=5>No products match. Clear the search to see everything.</tr>'; ?></table></div>
<?php bottom();
