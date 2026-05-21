<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatti · Wallah Kebab</title>
  <link rel="icon" type="image/png" href="kebabbazzo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="grafica.css">

  <style>
    :root {
      --bg: #0f0d0b;
      --bg-soft: #161310;
      --card: #1c1815;
      --line: rgba(255, 255, 255, 0.08);
      --text: #f4ece1;
      --muted: #b9ad9c;
      --accent: #d4a056;
      --accent-strong: #e7b46a;
    }

    body.contatti-page {
      margin: 0;
      min-height: 100vh;
      background:
        radial-gradient(1200px 600px at 80% -10%, rgba(212, 160, 86, 0.18), transparent 60%),
        radial-gradient(900px 500px at -10% 110%, rgba(212, 160, 86, 0.10), transparent 60%),
        var(--bg);
      color: var(--text);
      font-family: 'Manrope', system-ui, sans-serif;
      padding-bottom: 80px;
    }

    /* HEADER */
    .header {
      position: sticky;
      top: 0;
      z-index: 50;
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      background: rgba(15, 13, 11, 0.72);
      border-bottom: 1px solid var(--line);
      padding: 22px 32px 22px 120px;
    }

    .header h1 {
      margin: 0;
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 700;
      font-size: 1.5em;
      letter-spacing: 0.5px;
      color: var(--text);
    }

    .header h1 .accent { color: var(--accent); }

    .imageHome {
      position: fixed;
      top: 22px;
      left: 22px;
      z-index: 60;
    }

    /* CONTENUTO */
    .contenuto {
      max-width: 920px;
      margin: 64px auto 0;
      padding: 0 28px;
    }

    .eyebrow {
      display: inline-block;
      font-weight: 700;
      font-size: 0.72rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 16px;
    }

    .titolo-sezione {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 700;
      font-size: clamp(2rem, 4.5vw, 2.8rem);
      line-height: 1.1;
      margin: 0 0 18px;
      color: var(--text);
    }

    .titolo-sezione .accent { color: var(--accent); }

    .intro {
      font-size: 1.05rem;
      line-height: 1.7;
      color: var(--muted);
      max-width: 620px;
      margin: 0 0 36px;
    }

    .divider {
      width: 64px;
      height: 3px;
      background: var(--accent);
      border-radius: 999px;
      margin: 24px 0 36px;
    }

    /* GRIGLIA INFO */
    .info-griglia {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 18px;
      margin-top: 10px;
    }

    .info-box {
      position: relative;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0)), var(--card);
      border: 1px solid var(--line);
      border-radius: 16px;
      padding: 24px 22px;
      box-shadow: 0 18px 40px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.03);
      transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
      overflow: hidden;
    }

    .info-box::before {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      background: radial-gradient(400px 120px at 0% 0%, rgba(212,160,86,0.10), transparent 70%);
      opacity: 0.9;
    }

    .info-box > * { position: relative; }

    .info-box:hover {
      transform: translateY(-3px);
      border-color: rgba(212, 160, 86, 0.35);
      box-shadow: 0 24px 50px rgba(0,0,0,0.45), 0 0 0 1px rgba(212,160,86,0.1) inset;
    }

    .info-box .etichetta {
      font-size: 0.72rem;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      color: var(--accent);
      font-weight: 700;
      margin-bottom: 12px;
    }

    .info-box .valore {
      font-size: 1.02rem;
      font-weight: 500;
      color: var(--text);
      line-height: 1.6;
    }

    .info-box a {
      color: var(--text);
      text-decoration: none;
      border-bottom: 1px solid rgba(212,160,86,0.4);
      transition: color 0.2s ease, border-color 0.2s ease;
    }

    .info-box a:hover {
      color: var(--accent);
      border-bottom-color: var(--accent);
    }

    .info-griglia.credits { margin-top: 22px; }

    /* MAPPA */
    .mappa-wrap {
      margin-top: 56px;
    }

    .mappa-head {
      display: flex;
      align-items: baseline;
      gap: 14px;
      margin-bottom: 18px;
      flex-wrap: wrap;
    }

    .mappa-head h3 {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 700;
      font-size: 1.6rem;
      margin: 0;
      color: var(--text);
    }

    .mappa-head h3 .accent { color: var(--accent); }

    .mappa {
      border-radius: 18px;
      overflow: hidden;
      border: 1px solid var(--line);
      box-shadow: 0 30px 70px rgba(0,0,0,0.45);
    }

    .mappa iframe {
      width: 100%;
      height: 340px;
      border: none;
      display: block;
      filter: grayscale(0.25) contrast(0.95) brightness(0.92);
    }

    @media (max-width: 600px) {
      .header { padding: 20px 22px 20px 80px; }
      .contenuto { margin-top: 44px; padding: 0 20px; }
      .mappa iframe { height: 260px; }
    }
  </style>
</head>

<body class="contatti-page">

  <button class="imageHome" onclick="window.location.href='index.php'" aria-label="Home"></button>

  <div class="header">
    <h1>"<span class="accent">Wallah</span> Kebab" · Contatti</h1>
  </div>

  <div class="contenuto">

    <span class="eyebrow">Restiamo in contatto</span>
    <h2 class="titolo-sezione">Dove <span class="accent">trovarci</span></h2>

    <p class="intro">Siamo qui per qualsiasi domanda, prenotazione o semplicemente per dirci quanto ti è piaciuto il kebab. Scrivici, chiamaci o vieni a trovarci direttamente in locale.</p>

    <div class="divider"></div>

    <div class="info-griglia">

      <div class="info-box">
        <div class="etichetta">Indirizzo</div>
        <div class="valore">Via Dae Baeotte<br>Castelfranco (TV)</div>
      </div>

      <div class="info-box">
        <div class="etichetta">Telefono</div>
        <div class="valore">
          <a href="tel:+390000000000">+39 000 000 0000</a>
        </div>
      </div>

      <div class="info-box">
        <div class="etichetta">Email</div>
        <div class="valore">
          <a href="mailto:info@wallahkebab.it">info@wallahkebab.it</a>
        </div>
      </div>

      <div class="info-box">
        <div class="etichetta">Orari</div>
        <div class="valore">Lun – Dom<br>12:00 – 23:00</div>
      </div>

    </div>

    <div class="info-griglia credits">

      <div class="info-box">
        <div class="etichetta">Creatore del sito</div>
        <div class="valore">Bordin Davide</div>
      </div>

      <div class="info-box">
        <div class="etichetta">Direttore Grafico</div>
        <div class="valore">Giorgio Zampieri</div>
      </div>

    </div>

    <div class="mappa-wrap">
      <div class="mappa-head">
        <span class="eyebrow" style="margin:0;">Come arrivare</span>
        <h3>Vieni a <span class="accent">trovarci</span></h3>
      </div>
      <div class="mappa">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2789!2d11.9265!3d45.6732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4778116e4e4e4e4e%3A0x0!2sVia+dei+Carpani%2C+Castelfranco+Veneto%2C+TV!5e0!3m2!1sit!2sit!4v1"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

  </div>

</body>
</html>