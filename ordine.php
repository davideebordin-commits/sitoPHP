<?php
session_start();

if (!isset($_SESSION['nomeutente'])) {
    header("Location: login.php");
    exit;
}

$nomeutente = $_SESSION['nomeutente'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Nuovo Ordine - Wallah Kebab</title>
  <link rel="stylesheet" href="grafica.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Georgia, serif; background: #f7f5f0; color: #222; min-height: 100vh; padding-bottom: 60px; }
    .header { background: #111; color: #fff; padding: 18px 25px 18px 120px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
    .header h2 { font-size: 1.3em; font-style: italic; letter-spacing: 1px; color: #fff; border: none; }
    .menu-container { max-width: 700px; margin: 30px auto; padding: 0 20px; }
    .menu-section-title { font-size: 0.85em; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; color: #888; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 28px 0 12px; }
    .piatto-card { background: #fff; border: 1px solid #e0ddd8; border-radius: 6px; padding: 14px 16px; margin-bottom: 10px; display: flex; align-items: center; gap: 14px; transition: box-shadow 0.2s; }
    .piatto-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    .piatto-id { font-size: 10px; font-weight: bold; color: #888; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; padding: 2px 6px; white-space: nowrap; flex-shrink: 0; }
    .piatto-info { flex: 1; }
    .piatto-info .nome { font-weight: bold; font-size: 0.95em; }
    .piatto-info .desc { font-size: 0.82em; color: #777; margin-top: 2px; }
    .prezzo { font-weight: bold; white-space: nowrap; flex-shrink: 0; font-size: 0.95em; color: #111; }
    .qty-control { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
    .qty-btn { width: 30px; height: 30px; border: 2px solid #111; background: #fff; border-radius: 50%; font-size: 1.1em; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0 !important; color: #111; transition: background 0.15s, color 0.15s; line-height: 1; }
    .qty-btn:hover { background: #111; color: #fff; }
    .qty-display { width: 24px; text-align: center; font-weight: bold; font-size: 1em; }
    .riepilogo { max-width: 700px; margin: 30px auto 10px; padding: 0 20px; }
    .riepilogo-box { background: #111; color: #fff; border-radius: 8px; padding: 24px; }
    .riepilogo-box h3 { font-size: 1em; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 16px; color: #fff; text-align: left; border-bottom: 1px solid #444; padding-bottom: 10px; }
    #lista-riepilogo { list-style: none; min-height: 40px; }
    #lista-riepilogo li { display: flex; justify-content: space-between; padding: 5px 0; font-size: 0.92em; border-bottom: 1px solid #333; }
    #lista-riepilogo li:last-child { border-bottom: none; }
    .totale-riga { display: flex; justify-content: space-between; margin-top: 16px; font-size: 1.1em; font-weight: bold; border-top: 2px solid #555; padding-top: 12px; }
    .msg-vuoto { color: #888; font-style: italic; font-size: 0.9em; }

    /* Note extra */
    .note-wrapper { padding: 16px 24px 0; }
    .note-label { display: block; font-size: 0.75em; letter-spacing: 2px; text-transform: uppercase; color: #aaa; margin-bottom: 8px; }
    .note-textarea {
      width: 100%; background: #1a1a1a; border: 1px solid #444; border-radius: 4px;
      color: #fff; font-family: Georgia, serif; font-size: 0.9em; padding: 10px 12px;
      resize: vertical; min-height: 70px; outline: none; transition: border-color 0.2s;
    }
    .note-textarea::placeholder { color: #666; }
    .note-textarea:focus { border-color: #888; }
    .note-counter { text-align: right; font-size: 0.75em; color: #666; margin-top: 4px; }

    .bottone-conferma { display: block; width: calc(100% - 48px); margin: 16px 24px 0; background: #fff; color: #111; font-family: Georgia, serif; font-size: 1em; letter-spacing: 2px; text-transform: uppercase; padding: 16px !important; border: none; border-radius: 4px !important; cursor: pointer; font-weight: bold; transition: background 0.2s, color 0.2s; }
    .bottone-conferma:hover { background: #f0ebe2; }
    .bottone-conferma:disabled { background: #444; color: #888; cursor: not-allowed; }
  </style>
</head>
<body>

  <button class="imag<?php
session_start();

if (!isset($_SESSION['nomeutente'])) {
    header("Location: login.php");
    exit;
}

$nomeutente = $_SESSION['nomeutente'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuovo Ordine - Wallah Kebab</title>
  <link rel="stylesheet" href="grafica.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --nero: #111;
      --bianco: #fff;
      --grigio-chiaro: #f5f5f3;
      --bordo: #e0e0de;
      --grigio-medio: #999;
      --accent: #c0392b;
    }

    body {
      font-family: 'DM Sans', Georgia, sans-serif;
      background: var(--grigio-chiaro);
      color: var(--nero);
      min-height: 100vh;
      /* spazio per il carrello fisso in basso */
      padding-bottom: 180px;
      -webkit-font-smoothing: antialiased;
    }

    /* HEADER */
    .header {
      background: var(--nero);
      color: var(--bianco);
      padding: 18px 60px 18px 70px;
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-style: italic;
      font-weight: 400;
      color: var(--bianco);
      letter-spacing: 1px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* LOGO */
    .imageHome {
      background-image: url('kebabbazzo.png');
      background-size: contain;
      background-repeat: no-repeat;
      background-color: transparent;
      position: fixed;
      top: 14px;
      left: 15px;
      width: 42px;
      height: 42px;
      border: none;
      outline: none;
      padding: 0;
      cursor: pointer;
      z-index: 9999;
    }

    /* CONTENITORE */
    .menu-container {
      max-width: 560px;
      margin: 0 auto;
      padding: 16px 16px 0;
    }

    /* SEZIONE */
    .menu-section-title {
      font-size: 0.68rem;
      font-weight: 500;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--grigio-medio);
      border-bottom: 1px solid var(--bordo);
      padding-bottom: 8px;
      margin: 24px 0 10px;
    }

    /* PIATTO CARD */
    .piatto-card {
      background: var(--bianco);
      border: 1px solid var(--bordo);
      border-radius: 10px;
      padding: 14px 14px;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: box-shadow 0.2s;
    }

    .piatto-card.attivo {
      border-color: var(--nero);
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }

    .piatto-id {
      font-size: 9px;
      font-weight: 500;
      color: var(--grigio-medio);
      background: var(--grigio-chiaro);
      border: 1px solid var(--bordo);
      border-radius: 3px;
      padding: 2px 5px;
      white-space: nowrap;
      flex-shrink: 0;
      letter-spacing: 0.5px;
    }

    .piatto-info {
      flex: 1;
      min-width: 0;
    }

    .piatto-info .nome {
      font-weight: 500;
      font-size: 0.9rem;
      line-height: 1.3;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .piatto-info .desc {
      font-size: 0.75rem;
      color: #777;
      margin-top: 2px;
      line-height: 1.3;
      /* su mobile mostriamo max 2 righe */
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .prezzo {
      font-weight: 500;
      white-space: nowrap;
      flex-shrink: 0;
      font-size: 0.9rem;
      color: var(--nero);
    }

    /* CONTROLLO QUANTITÀ */
    .qty-control {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-shrink: 0;
    }

    .qty-btn {
      width: 34px;
      height: 34px;
      border: 2px solid var(--nero);
      background: var(--bianco);
      border-radius: 50%;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 !important;
      color: var(--nero);
      transition: background 0.15s, color 0.15s;
      line-height: 1;
      /* tap target */
      min-width: 34px;
      min-height: 34px;
    }

    .qty-btn:hover,
    .qty-btn:active {
      background: var(--nero);
      color: var(--bianco);
    }

    .qty-display {
      width: 22px;
      text-align: center;
      font-weight: 600;
      font-size: 0.95rem;
    }

    /* CARRELLO FISSO IN BASSO */
    .carrello-fisso {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: var(--nero);
      color: var(--bianco);
      z-index: 200;
      padding: 16px 20px 20px;
      max-width: 560px;
      margin: 0 auto;
    }

    /* su desktop il carrello rimane centrato */
    @media (min-width: 560px) {
      .carrello-fisso {
        left: 50%;
        right: auto;
        transform: translateX(-50%);
        width: 560px;
        border-radius: 12px 12px 0 0;
      }
    }

    .carrello-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
      cursor: pointer;
      user-select: none;
    }

    .carrello-titolo {
      font-size: 0.68rem;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #aaa;
    }

    .carrello-toggle {
      font-size: 0.75rem;
      color: #aaa;
      letter-spacing: 1px;
    }

    /* lista riepilogo (collassabile) */
    .carrello-lista-wrap {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.3s ease;
    }

    .carrello-lista-wrap.aperto {
      max-height: 300px;
    }

    #lista-riepilogo {
      list-style: none;
      border-bottom: 1px solid #333;
      margin-bottom: 10px;
      padding-bottom: 8px;
    }

    #lista-riepilogo li {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
      font-size: 0.85rem;
      border-bottom: 1px solid #2a2a2a;
    }

    #lista-riepilogo li:last-child { border-bottom: none; }

    .msg-vuoto { color: #666; font-style: italic; font-size: 0.85rem; }

    /* Note */
    .note-wrapper { padding: 10px 0 12px; }

    .note-label {
      display: block;
      font-size: 0.68rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #aaa;
      margin-bottom: 6px;
    }

    .note-textarea {
      width: 100%;
      background: #1a1a1a;
      border: 1px solid #444;
      border-radius: 6px;
      color: var(--bianco);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem;
      padding: 10px 12px;
      resize: none;
      height: 60px;
      outline: none;
      transition: border-color 0.2s;
    }

    .note-textarea::placeholder { color: #555; }
    .note-textarea:focus { border-color: #888; }

    .note-counter {
      text-align: right;
      font-size: 0.7rem;
      color: #555;
      margin-top: 3px;
    }

    /* RIGA TOTALE + BOTTONE */
    .carrello-bottom {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-top: 4px;
    }

    .totale-label {
      font-size: 1rem;
      font-weight: 600;
      white-space: nowrap;
    }

    .totale-label span {
      font-size: 0.75rem;
      font-weight: 300;
      color: #aaa;
      margin-right: 4px;
    }

    .bottone-conferma {
      flex: 1;
      background: var(--accent);
      color: var(--bianco);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 14px 10px !important;
      border: none;
      border-radius: 6px !important;
      cursor: pointer;
      transition: background 0.2s;
      min-height: 48px;
    }

    .bottone-conferma:hover,
    .bottone-conferma:active { background: #a93226; }

    .bottone-conferma:disabled {
      background: #333;
      color: #666;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

  <button class="imageHome" onclick="window.location.href='index.php'"></button>

  <div class="header">
    <h2>Ordine — <?= htmlspecialchars($nomeutente) ?></h2>
  </div>

  <div class="menu-container">

    <div class="menu-section-title">Kebab &amp; Wrap</div>

    <div class="piatto-card" data-id="001">
      <span class="piatto-id">#001</span>
      <div class="piatto-info">
        <div class="nome">Kebab nel pane</div>
        <div class="desc">Pita, carne mista, insalata, pomodoro, cipolla e salsa a scelta</div>
      </div>
      <div class="prezzo">€ 6</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="002">
      <span class="piatto-id">#002</span>
      <div class="piatto-info">
        <div class="nome">Durum wrap</div>
        <div class="desc">Pane yufka, carne, verdure grigliate e salsa piccante</div>
      </div>
      <div class="prezzo">€ 7</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="003">
      <span class="piatto-id">#003</span>
      <div class="piatto-info">
        <div class="nome">Kebab box</div>
        <div class="desc">Carne su riso basmati con insalata e salsa bianca</div>
      </div>
      <div class="prezzo">€ 9</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Piatti Caldi</div>

    <div class="piatto-card" data-id="004">
      <span class="piatto-id">#004</span>
      <div class="piatto-info">
        <div class="nome">Lahmacun</div>
        <div class="desc">Pizza turca sottile con carne macinata speziata e limone</div>
      </div>
      <div class="prezzo">€ 7</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="005">
      <span class="piatto-id">#005</span>
      <div class="piatto-info">
        <div class="nome">Pide con carne</div>
        <div class="desc">Barca di pane con carne, peperone e formaggio fuso</div>
      </div>
      <div class="prezzo">€ 9</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="006">
      <span class="piatto-id">#006</span>
      <div class="piatto-info">
        <div class="nome">Pollo alla griglia</div>
        <div class="desc">Petto marinato con spezie turche, servito con patatine</div>
      </div>
      <div class="prezzo">€ 10</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Contorni &amp; Bevande</div>

    <div class="piatto-card" data-id="007">
      <span class="piatto-id">#007</span>
      <div class="piatto-info">
        <div class="nome">Patatine fritte</div>
        <div class="desc">Croccanti, con salsa a scelta</div>
      </div>
      <div class="prezzo">€ 3</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="008">
      <span class="piatto-id">#008</span>
      <div class="piatto-info">
        <div class="nome">Ayran</div>
        <div class="desc">Yogurt turco salato, freddo</div>
      </div>
      <div class="prezzo">€ 2</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Dolci</div>

    <div class="piatto-card" data-id="009">
      <span class="piatto-id">#009</span>
      <div class="piatto-info">
        <div class="nome">Baklava</div>
        <div class="desc">Pasta sfoglia con pistacchi e sciroppo di miele (2 pezzi)</div>
      </div>
      <div class="prezzo">€ 4</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="010">
      <span class="piatto-id">#010</span>
      <div class="piatto-info">
        <div class="nome">Künefe</div>
        <div class="desc">Pasta di semola croccante con formaggio filante e sciroppo</div>
      </div>
      <div class="prezzo">€ 6</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

  </div>

  <!-- CARRELLO FISSO IN BASSO -->
  <div class="carrello-fisso">

    <div class="carrello-header" onclick="toggleCarrello()">
      <span class="carrello-titolo">Il tuo ordine</span>
      <span class="carrello-toggle" id="toggle-label">▲ vedi dettaglio</span>
    </div>

    <div class="carrello-lista-wrap" id="carrello-lista">
      <ul id="lista-riepilogo">
        <li><span class="msg-vuoto">Nessun articolo selezionato</span></li>
      </ul>

      <div class="note-wrapper">
        <label class="note-label" for="note-extra">📝 Note (allergie, salse, preferenze…)</label>
        <textarea id="note-extra" class="note-textarea" maxlength="300"
          placeholder="Es: senza cipolla, extra salsa piccante…"></textarea>
        <div class="note-counter"><span id="note-count">0</span>/300</div>
      </div>
    </div>

    <div class="carrello-bottom">
      <div class="totale-label">
        <span>Totale</span>
        <span id="totale">€ 0</span>
      </div>
      <button class="bottone-conferma" id="btn-conferma" disabled onclick="confermaOrdine()">
        Conferma
      </button>
    </div>

  </div>

  <script>
    let carrelloAperto = false;

    function toggleCarrello() {
      carrelloAperto = !carrelloAperto;
      const wrap = document.getElementById('carrello-lista');
      const label = document.getElementById('toggle-label');
      wrap.classList.toggle('aperto', carrelloAperto);
      label.textContent = carrelloAperto ? '▼ chiudi' : '▲ vedi dettaglio';
    }

    function cambia(btn, delta) {
      const card = btn.closest('.piatto-card');
      const display = card.querySelector('.qty-display');
      let qty = parseInt(display.textContent) + delta;
      if (qty < 0) qty = 0;
      display.textContent = qty;
      card.classList.toggle('attivo', qty > 0);
      aggiornaRiepilogo();
    }

    function aggiornaRiepilogo() {
      const cards = document.querySelectorAll('.piatto-card');
      const lista = document.getElementById('lista-riepilogo');
      const totaleEl = document.getElementById('totale');
      const btnConferma = document.getElementById('btn-conferma');

      lista.innerHTML = '';
      let totale = 0;
      let haVoci = false;

      cards.forEach(card => {
        const qty = parseInt(card.querySelector('.qty-display').textContent);
        if (qty > 0) {
          haVoci = true;
          const nome = card.querySelector('.nome').textContent;
          const prezzotxt = card.querySelector('.prezzo').textContent.replace('€', '').trim();
          const prezzo = parseFloat(prezzotxt);
          const sub = prezzo * qty;
          totale += sub;
          const li = document.createElement('li');
          li.innerHTML = `<span>${qty}× ${nome}</span><span>€ ${sub.toFixed(0)}</span>`;
          lista.appendChild(li);
        }
      });

      if (!haVoci) {
        lista.innerHTML = '<li><span class="msg-vuoto">Nessun articolo selezionato</span></li>';
      }

      totaleEl.textContent = '€ ' + totale.toFixed(0);
      btnConferma.disabled = !haVoci;

      // apri automaticamente il carrello quando si aggiunge il primo articolo
      if (haVoci && !carrelloAperto) toggleCarrello();
    }

    // Contatore note
    const noteEl = document.getElementById('note-extra');
    const noteCount = document.getElementById('note-count');
    noteEl.addEventListener('input', () => {
      noteCount.textContent = noteEl.value.length;
    });

    function confermaOrdine() {
      const note = document.getElementById('note-extra').value.trim();
      const dati = [];

      document.querySelectorAll('.piatto-card').forEach(card => {
        const qty = parseInt(card.querySelector('.qty-display').textContent);
        if (qty > 0) {
          dati.push({
            id:     card.dataset.id,
            nome:   card.querySelector('.nome').textContent,
            prezzo: parseFloat(card.querySelector('.prezzo').textContent.replace('€','').trim()),
            qty:    qty
          });
        }
      });

      fetch('salva_ordine.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ voci: dati, note: note })
      })
      .then(res => res.json())
      .then(data => {
        if (data.ok) {
          window.location.href = 'pagamento.php';
        } else {
          alert('Errore nel salvataggio dell\'ordine: ' + (data.errore ?? ''));
        }
      })
      .catch(() => alert('Errore di rete. Riprova.'));
    }
  </script>

</body>
</html>eHome" onclick="window.location.href='index.php'"></button>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="header">
    <h2>Nuovo ordine di: <?= htmlspecialchars($nomeutente) ?></h2>
  </div>

  <div class="menu-container">

    <div class="menu-section-title">Kebab &amp; Wrap</div>

    <div class="piatto-card" data-id="001">
      <span class="piatto-id">#001</span>
      <div class="piatto-info">
        <div class="nome">Kebab nel pane</div>
        <div class="desc">Pita, carne mista, insalata, pomodoro, cipolla e salsa a scelta</div>
      </div>
      <div class="prezzo">€ 6</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="002">
      <span class="piatto-id">#002</span>
      <div class="piatto-info">
        <div class="nome">Durum wrap</div>
        <div class="desc">Pane yufka, carne, verdure grigliate e salsa piccante</div>
      </div>
      <div class="prezzo">€ 7</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="003">
      <span class="piatto-id">#003</span>
      <div class="piatto-info">
        <div class="nome">Kebab box</div>
        <div class="desc">Carne su riso basmati con insalata e salsa bianca</div>
      </div>
      <div class="prezzo">€ 9</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Piatti Caldi</div>

    <div class="piatto-card" data-id="004">
      <span class="piatto-id">#004</span>
      <div class="piatto-info">
        <div class="nome">Lahmacun</div>
        <div class="desc">Pizza turca sottile con carne macinata speziata e limone</div>
      </div>
      <div class="prezzo">€ 7</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="005">
      <span class="piatto-id">#005</span>
      <div class="piatto-info">
        <div class="nome">Pide con carne</div>
        <div class="desc">Barca di pane con carne, peperone e formaggio fuso</div>
      </div>
      <div class="prezzo">€ 9</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="006">
      <span class="piatto-id">#006</span>
      <div class="piatto-info">
        <div class="nome">Pollo alla griglia</div>
        <div class="desc">Petto marinato con spezie turche, servito con patatine</div>
      </div>
      <div class="prezzo">€ 10</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Contorni &amp; Bevande</div>

    <div class="piatto-card" data-id="007">
      <span class="piatto-id">#007</span>
      <div class="piatto-info">
        <div class="nome">Patatine fritte</div>
        <div class="desc">Croccanti, con salsa a scelta</div>
      </div>
      <div class="prezzo">€ 3</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="008">
      <span class="piatto-id">#008</span>
      <div class="piatto-info">
        <div class="nome">Ayran</div>
        <div class="desc">Yogurt turco salato, freddo</div>
      </div>
      <div class="prezzo">€ 2</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="menu-section-title">Dolci</div>

    <div class="piatto-card" data-id="009">
      <span class="piatto-id">#009</span>
      <div class="piatto-info">
        <div class="nome">Baklava</div>
        <div class="desc">Pasta sfoglia con pistacchi e sciroppo di miele (2 pezzi)</div>
      </div>
      <div class="prezzo">€ 4</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

    <div class="piatto-card" data-id="010">
      <span class="piatto-id">#010</span>
      <div class="piatto-info">
        <div class="nome">Künefe</div>
        <div class="desc">Pasta di semola croccante con formaggio filante e sciroppo</div>
      </div>
      <div class="prezzo">€ 6</div>
      <div class="qty-control">
        <button class="qty-btn" onclick="cambia(this, -1)">−</button>
        <span class="qty-display">0</span>
        <button class="qty-btn" onclick="cambia(this, 1)">+</button>
      </div>
    </div>

  </div>

  <!-- Riepilogo -->
  <div class="riepilogo">
    <div class="riepilogo-box">
      <h3>Il tuo ordine</h3>
      <ul id="lista-riepilogo">
        <li><span class="msg-vuoto">Nessun articolo selezionato</span></li>
      </ul>
      <div class="totale-riga">
        <span>Totale</span>
        <span id="totale">€ 0</span>
      </div>
    </div>

    <!-- Note extra -->
    <div class="note-wrapper">
      <label class="note-label" for="note-extra">
        📝 Note extra (allergie, preferenze, salse…)
      </label>
      <textarea id="note-extra" class="note-textarea" maxlength="300"
        placeholder="Es: allergia ai frutti di mare, extra salsa piccante, senza cipolla…"></textarea>
      <div class="note-counter"><span id="note-count">0</span>/300</div>
    </div>

    <button class="bottone-conferma" id="btn-conferma" disabled onclick="confermaOrdine()">
      Conferma Ordine
    </button>
  </div>

  <script>
    function cambia(btn, delta) {
      const card = btn.closest('.piatto-card');
      const display = card.querySelector('.qty-display');
      let qty = parseInt(display.textContent) + delta;
      if (qty < 0) qty = 0;
      display.textContent = qty;
      aggiornaRiepilogo();
    }

    function aggiornaRiepilogo() {
      const cards = document.querySelectorAll('.piatto-card');
      const lista = document.getElementById('lista-riepilogo');
      const totaleEl = document.getElementById('totale');
      const btnConferma = document.getElementById('btn-conferma');

      lista.innerHTML = '';
      let totale = 0;
      let haVoci = false;

      cards.forEach(card => {
        const qty = parseInt(card.querySelector('.qty-display').textContent);
        if (qty > 0) {
          haVoci = true;
          const nome = card.querySelector('.nome').textContent;
          const prezzotxt = card.querySelector('.prezzo').textContent.replace('€', '').trim();
          const prezzo = parseFloat(prezzotxt);
          const sub = prezzo * qty;
          totale += sub;
          const li = document.createElement('li');
          li.innerHTML = `<span>${qty}× ${nome}</span><span>€ ${sub.toFixed(0)}</span>`;
          lista.appendChild(li);
        }
      });

      if (!haVoci) {
        lista.innerHTML = '<li><span class="msg-vuoto">Nessun articolo selezionato</span></li>';
      }

      totaleEl.textContent = '€ ' + totale.toFixed(0);
      btnConferma.disabled = !haVoci;
    }

    // Contatore caratteri note
    const noteEl = document.getElementById('note-extra');
    const noteCount = document.getElementById('note-count');
    noteEl.addEventListener('input', () => {
      noteCount.textContent = noteEl.value.length;
    });

    function confermaOrdine() {
      const note = document.getElementById('note-extra').value.trim();
      const dati = [];

      document.querySelectorAll('.piatto-card').forEach(card => {
        const qty = parseInt(card.querySelector('.qty-display').textContent);
        if (qty > 0) {
          dati.push({
            id:     card.dataset.id,
            nome:   card.querySelector('.nome').textContent,
            prezzo: parseFloat(card.querySelector('.prezzo').textContent.replace('€','').trim()),
            qty:    qty
          });
        }
      });

      fetch('salva_ordine.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ voci: dati, note: note })
      })
      .then(res => res.json())
      .then(data => {
        if (data.ok) {
          window.location.href = 'pagamento.php';
        } else {
          alert('Errore nel salvataggio dell\'ordine: ' + (data.errore ?? ''));
        }
      })
      .catch(() => alert('Errore di rete. Riprova.'));
    }
  </script>

</body>
</html>