<?php require 'includes/layout.php'; top('Welcome', false);
$tags = [['Bananas 1kg','1.20'],['Sourdough Loaf','3.90'],['Whole Milk 1L','1.35'],['Cheddar 200g','3.40'],['Orange Juice 1L','2.75'],['Tomatoes 1kg','2.10'],['Croissant','1.60'],['Dark Chocolate','2.50']]; ?>
<header class="hero"><div class="bar"><?= logo() ?><a class="btn" href="login.php">Log in</a></div>
<div class="hero-grid"><div class="hero-body"><h1>Every shelf, every sale, in one place.</h1>
<p>Track stock, ring up customers and see the day's takings without a single spreadsheet.</p>
<a class="btn big" href="login.php">Open the store</a></div>
<div class="receipt" aria-hidden="true"><h4>Grocery Store<br>Management system</h4><hr>
<p class="ln"><span>Sourdough Loaf</span><b>3.90</b></p><p class="ln"><span>Orange Juice 1L</span><b>2.75</b></p><p class="ln"><span>Whole Milk 1L</span><b>1.35</b></p>
<p class="ln"><span>Bananas 1kg</span><b>1.20</b></p><p class="ln"><span>Dark Chocolate</span><b>2.50</b></p><p class="ln"><span>Tomatoes 1kg</span><b>2.10</b></p><hr>
<p class="ln tot"><span>Total</span><b class="count" data-to="13.8" data-delay="2200">0.00</b></p><small>Stock updated. Thank you!</small></div></div>
<div class="marquee" aria-hidden="true"><div><?php for ($i=0;$i<2;$i++) foreach ($tags as $t) echo "<span class='pt'><i></i>{$t[0]} <b>{$t[1]}</b></span>"; ?></div></div></header>
<section class="feat"><div><b>Stock that warns you</b><p>Items below their minimum are flagged before the shelf is empty.</p></div>
<div><b>Billing in seconds</b><p>Search, tap, checkout. Stock updates itself.</p></div>
<div><b>Daily takings</b><p>Revenue and recent sales on one dashboard.</p></div></section>
<footer class="foot"><?= logo() ?><span>Built with PHP and MySQL</span></footer>
<?php bottom();
