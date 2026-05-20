<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Siamo — Wallah Kebab</title>
  <link rel="icon" type="image/png" href="kebabbazzo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,500;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="grafica.css">
  <style>
    /* ----- STILI SPECIFICI CHI SIAMO ----- */
    body {
      background-image:
        radial-gradient(1200px 600px at 80% -10%, rgba(245,158,11,0.10), transparent 60%),
        radial-gradient(900px 500px at -10% 30%, rgba(239,68,68,0.08), transparent 60%);
    }

    .hero-chi {
      padding: 140px 24px 50px;
      text-align: center;
      max-width: 1000px;
      margin: 0 auto;
    }
    .hero-chi .eyebrow {
      display: inline-block;
      padding: 6px 14px;
      border: 1px solid var(--card-border);
      border-radius: 999px;
      font-size: 0.78rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--accent);
      background: var(--accent-soft);
      margin-bottom: 18px;
    }
    .hero-chi h1 {
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-weight: 700;
      font-size: clamp(2.5rem, 6.5vw, 5rem);
      line-height: 1.05;
      margin-bottom: 14px;
    }
    .hero-chi h1 .accent { color: var(--accent); }
    .hero-chi .sub {
      color: var(--muted);
      max-width: 620px;
      margin: 0 auto;
      font-size: 1.05rem;
    }

    /* Sezione storia */
    .storia {
      max-width: 850px;
      margin: 20px auto 60px;
      padding: 0 24px;
    }
    .storia-card {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 22px;
      padding: 50px 45px;
      backdrop-filter: blur(14px);
    }
    .storia-card p {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #e8e2d6;
      margin-bottom: 22px;
    }
    .storia-card p:last-child { margin-bottom: 0; }
    .storia-card p .accent {
      color: var(--accent);
      font-weight: 600;
      font-style: italic;
    }

    .divider {
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--accent-2));
      border-radius: 3px;
      margin: 28px 0;
    }

    /* Info grid */
    .info-section {
      max-width: 1100px;
      margin: 0 auto 100px;
      padding: 0 24px;
    }
    .info-section .section-title {
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-size: 1.8rem;
      text-align: center;
      margin-bottom: 34px;
    }
    .info-section .section-title .accent { color: var(--accent); }

    .info-griglia {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
    }
    .info-box {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 18px;
      padding: 28px;
      backdrop-filter: blur(14px);
      transition: transform .25s, border-color .25s, background .25s;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .info-box:hover {
      transform: translateY(-4px);
      border-color: rgba(245, 158, 11, 0.4);
      background: rgba(245, 158, 11, 0.04);
    }
    .info-box .icon {
      width: 44px; height: 44px;
      border-radius: 12px;
      background: var(--accent-soft);
      color: var(--accent);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }
    .info-box .etichetta {
      font-size: 0.78rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--muted);
    }
    .info-box .valore {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      line-height: 1.4;
    }

    /* Quote box */
    .quote-box {
      max-width: 850px;
      margin: 0 auto 80px;
      padding: 0 24px;
      text-align: center;
    }
    .quote-box blockquote {
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-size: clamp(1.4rem, 3vw, 2rem);
      line-height: 1.4;
      color: var(--text);
      position: relative;
      padding: 0 30px;
    }
    .quote-box blockquote::before,
    .quote-box blockquote::after {
      content: '"';
      color: var(--accent);
      font-size: 3rem;
      font-weight: 700;
      line-height: 0;
      position: relative;
      top: 12px;
    }
    .quote-box .firma {
      margin-top: 22px;
      color: var(--muted);
      font-size: 0.9rem;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    @media (max-width: 600px) {
      .hero-chi { padding: 120px 20px 30px; }
      .storia-card { padding: 32px 24px; }
      .info-box { padding: 22px; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <button class="imageHome" onclick="window.location.href='index.php'" aria-label="Home"></button>

  <button class="hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <aside class="tenda" id="tenda">
    <div class="tenda-header">
      <span class="eyebrow">Menu</span>
      <h3>Esplora<br>il locale</h3>
    </div>

    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="recensioni.php">Recensioni</a>
      <a href="chisiamo.php">Chi siamo</a>
      <a href="contatti.php">Contatti</a>
      <a href="login.php">Ordina ora</a>
    </nav>

    <div class="tenda-footer">&copy; 2026 Wallah Kebab</div>
  </aside>

  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <!-- HERO -->
  <section class="hero-chi">
    <span class="eyebrow">La nostra storia</span>
    <h1>Chi <span class="accent">siamo</span></h1>
    <p class="sub">Passione, tradizione e ingredienti freschi: la formula che da anni conquista i palati di Castelfranco.</p>
  </section>

  <!-- STORIA -->
  <section class="storia">
    <div class="storia-card">
      <p>Benvenuti su <span class="accent">Wallah Kebab</span>, il vostro punto di riferimento per il miglior kebab della città. Siamo appassionati di cucina e ci impegniamo a offrire un'esperienza culinaria autentica e deliziosa.</p>

      <div class="divider"></div>

      <p>La nostra missione è portare i sapori tradizionali del <span class="accent">Medio Oriente</span> direttamente nel vostro piatto, utilizzando ingredienti freschi e di alta qualità. Che siate amanti del kebab classico o alla ricerca di nuove varianti, da noi troverete sempre qualcosa di speciale da gustare.</p>

      <p>Grazie per essere parte della nostra famiglia di amanti del kebab!</p>
    </div>
  </section>

  <!-- QUOTE -->
  <section class="quote-box">
    <blockquote>Ogni kebab racconta una storia di tradizione, fuoco e sapore.</blockquote>
    <div class="firma">— Il team Wallah</div>
  </section>

  <!-- INFO -->
  <section class="info-section">
    <h2 class="section-title">Le nostre <span class="accent">info</span></h2>

    <div class="info-griglia">
      <div class="info-box">
        <div class="icon">🕒</div>
        <div class="etichetta">Orari</div>
        <div class="valore">Lun — Dom<br>12:00 — 23:00</div>
      </div>
      <div class="info-box">
        <div class="icon">📍</div>
        <div class="etichetta">Dove siamo</div>
        <div class="valore">Via Dae Baeotte<br>Castelfranco (TV)</div>
      </div>
      <div class="info-box">
        <div class="icon">📞</div>
        <div class="etichetta">Contatti</div>
        <div class="valore">+39 000 000 0000</div>
      </div>
    </div>
  </section>

  <footer>
    &copy; 2026 Wallah Kebab. Tutti i diritti riservati.
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('tenda').classList.toggle('aperta');
      document.getElementById('overlay').classList.toggle('attivo');
      document.getElementById('hamburger').classList.toggle('aperto');
    }
  </script>
</body>
</html>