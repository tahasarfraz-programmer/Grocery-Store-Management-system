<?php require 'includes/layout.php';
if (!$pdo->query('SELECT COUNT(*) c FROM users')->fetch()['c'])
  $pdo->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)')->execute(['Store Admin','admin@grocery.local',password_hash('admin123',PASSWORD_DEFAULT),'admin']);
$err = '';
if ($_POST) { $s = $pdo->prepare('SELECT * FROM users WHERE email=?'); $s->execute([$_POST['email']]); $u = $s->fetch();
  if ($u && password_verify($_POST['password'], $u['password'])) { $_SESSION['u'] = $u; header('Location: dashboard.php'); exit; }
  $err = 'Email or password is wrong. Try again.'; }
top('Log in', false); ?>
<div class="login"><form method="post" class="card"><?= logo() ?><h2>Welcome back</h2>
<?php if ($err) echo '<p class="err">'.e($err).'</p>'; ?>
<label>Email<input name="email" type="email" value="admin@grocery.local" required></label>
<label>Password<input name="password" type="password" value="admin123" required></label>
<button class="btn big">Log in</button></form></div>
<?php bottom();
