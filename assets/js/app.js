// Page transition: curtain wipes in on link click, out on load
document.addEventListener('click', e => { const a = e.target.closest('a[href]');
  if (!a || a.target || a.origin !== location.origin) return;
  e.preventDefault(); document.body.classList.add('leaving'); setTimeout(() => location.href = a.href, 350); });
// Animated stat counters
document.querySelectorAll('.count').forEach(el => { const to = parseFloat(el.dataset.to), t0 = performance.now() + (+el.dataset.delay || 0), dec = to % 1;
  const f = t => { const p = Math.min(Math.max((t - t0) / 1100, 0), 1), v = to * (1 - Math.pow(1 - p, 3)); el.textContent = dec ? v.toFixed(2) : Math.round(v); if (p < 1) requestAnimationFrame(f); }; requestAnimationFrame(f); });
// Billing
if (window.PRODUCTS) { const cart = {}, $ = id => document.getElementById(id);
  const draw = () => { const q = $('find').value.toLowerCase();
    $('grid').innerHTML = PRODUCTS.filter(p => p.name.toLowerCase().includes(q)).map(p => `<button class="item" data-id="${p.id}"><b>${p.name}</b><span>${(+p.price).toFixed(2)} · ${p.stock} in stock</span></button>`).join('') || '<p>No product found.</p>';
    const ids = Object.keys(cart); let tot = 0;
    $('lines').innerHTML = ids.map(id => { const p = PRODUCTS.find(x => x.id == id); tot += p.price * cart[id];
      return `<p class="row">${p.name}<span><button data-m="${id}">−</button> ${cart[id]} <button data-p="${id}">+</button></span></p>`; }).join('') || '<p>Tap a product to add it.</p>';
    $('tot').textContent = tot.toFixed(2); };
  document.addEventListener('click', e => { const b = e.target.closest('button'); if (!b) return;
    const add = (id, n) => { const p = PRODUCTS.find(x => x.id == id); cart[id] = Math.min(+p.stock, (cart[id] || 0) + n); if (cart[id] < 1) delete cart[id]; draw(); };
    if (b.dataset.id) add(b.dataset.id, 1); if (b.dataset.p) add(b.dataset.p, 1); if (b.dataset.m) add(b.dataset.m, -1); });
  $('find').oninput = draw;
  $('pay').onclick = async () => { const items = Object.entries(cart).map(([id, qty]) => ({ id, qty })); if (!items.length) return;
    const r = await (await fetch('pos.php', { method: 'POST', body: JSON.stringify({ items, customer: $('cust').value }) })).json();
    $('msg').textContent = r.ok ? `Sale #${r.id} saved: ${(+r.total).toFixed(2)}` : r.msg; if (r.ok) setTimeout(() => location.reload(), 1200); };
  draw(); }
