<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu - Wallah Kebab</title>
  <link rel="stylesheet" href="grafica.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    :root {
      --nero: #111;
      --bianco: #fff;
      --grigio-chiaro: #f5f5f3;
      --grigio-medio: #999;
      --bordo: #e0e0e0;
      --accent: #c0392b;
    }

    html, body {
      margin: 0;
      padding: 0;
      background: var(--bianco);
      color: var(--nero);
      font-family: 'DM Sans', sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    .imageHome {
      position: fixed;
      top: 18px;
      left: 18px;
      z-index: 200;
    }

    .header {
      background: var(--nero);
      color: var(--bianco);
      padding: 28px 20px 22px 110px;
      text-align: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      margin: 0 0 4px;
      letter-spacing: 1px;
    }

    .header .sottotitolo {
      font-size: 0.85rem;
      font-style: italic;
      color: var(--grigio-medio);
      margin: 0;
    }

    .bottone-ordina {
      display: block;
      width: calc(100% - 32px);
      margin: 16px auto;
      background: var(--accent);
      color: var(--bianco);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 16px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: background 0.2s;
    }

    .bottone-ordina:hover,
    .bottone-ordina:active {
      background: #a93226;
    }

    .sezione {
      padding: 0 16px;
    }

    .sezione-titolo {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.7rem;
      font-weight: 500;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--grigio-medio);
      margin: 28px 0 10px;
      padding-bottom: 8px;
      border-bottom: 1px solid var(--bordo);
    }

    .piatto {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 14px 0;
      border-bottom: 1px solid var(--bordo);
    }

    .piatto:last-child {
      border-bottom: none;
    }

    .piatto-id {
      font-size: 10px;
      font-weight: 500;
      color: var(--grigio-medio);
      background: var(--grigio-chiaro);
      border-radius: 3px;
      padding: 3px 6px;
      white-space: nowrap;
      flex-shrink: 0;
      margin-top: 3px;
      letter-spacing: 0.5px;
    }

    .piatto-info {
      flex: 1;
      min-width: 0;
    }

    .piatto-info .nome {
      font-weight: 500;
      font-size: 1rem;
      margin-bottom: 3px;
      line-height: 1.3;
    }

    .piatto-info .desc {
      font-size: 0.82rem;
      color: #666;
      line-height: 1.45;
      font-weight: 300;
    }

    .prezzo {
      font-weight: 500;
      font-size: 1rem;
      white-space: nowrap;
      flex-shrink: 0;
      color: var(--nero);
    }

    footer {
      background: var(--grigio-chiaro);
      margin-top: 32px;
      padding: 24px 20px;
      text-align: center;
      font-size: 0.8rem;
      color: var(--grigio-medio);
      line-height: 1.8;
    }

    footer strong {
      color: var(--nero);
      font-weight: 500;
    }

    @media (min-width: 480px) {
      body {
        max-width: 520px;
        margin: 0 auto;
        box-shadow: 0 0 40px rgba(0,0,0,0.08);
        min-height: 100vh;
      }

      .header {
        position: static;
      }
    }

    @media (max-width: 380px) {
      .header { padding-left: 90px; }
    }
  </style>
</head>
<body>

  <button class="imageHome" onclick="window.location.href='index.php'" aria-label="Torna alla home"></button>

  <div class="header">
    <h1>Wallah Kebab</h1>
    <p class="sottotitolo">er mejo</p>
  </div>

  <div class="sezione">
    <a class="bottone-ordina" href="login.php">Ordina Qui</a>
  </div>

  <!-- KEBAB & WRAP -->
  <div class="sezione">
    <div class="sezione-titolo">Kebab &amp; Wrap</div>

    <div class="piatto">
      <span class="piatto-id">#001</span>
      <div class="piatto-info">
        <div class="nome">Kebab nel pane</div>
        <div class="desc">Pita, carne mista, insalata, pomodoro, cipolla e salsa a scelta</div>
      </div>
      <div class="prezzo">€ 6</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#002</span>
      <div class="piatto-info">
        <div class="nome">Durum wrap</div>
        <div class="desc">Pane yufka, carne, verdure grigliate e salsa piccante</div>
      </div>
      <div class="prezzo">€ 7</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#003</span>
      <div class="piatto-info">
        <div class="nome">Kebab box</div>
        <div class="desc">Carne su riso basmati con insalata e salsa bianca</div>
      </div>
      <div class="prezzo">€ 9</div>
    </div>
  </div>

  <!-- PIATTI CALDI -->
  <div class="sezione">
    <div class="sezione-titolo">Piatti Caldi</div>

    <div class="piatto">
      <span class="piatto-id">#004</span>
      <div class="piatto-info">
        <div class="nome">Lahmacun</div>
        <div class="desc">Pizza turca sottile con carne macinata speziata e limone</div>
      </div>
      <div class="prezzo">€ 7</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#005</span>
      <div class="piatto-info">
        <div class="nome">Pide con carne</div>
        <div class="desc">Barca di pane con carne, peperone e formaggio fuso</div>
      </div>
      <div class="prezzo">€ 9</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#006</span>
      <div class="piatto-info">
        <div class="nome">Pollo alla griglia</div>
        <div class="desc">Petto marinato con spezie turche, servito con patatine</div>
      </div>
      <div class="prezzo">€ 10</div>
    </div>
  </div>

  <!-- CONTORNI -->
  <div class="sezione">
    <div class="sezione-titolo">Contorni</div>

    <div class="piatto">
      <span class="piatto-id">#007</span>
      <div class="piatto-info">
        <div class="nome">Patatine fritte</div>
        <div class="desc">Croccanti, con salsa a scelta</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>
  </div>

  <!-- BIBITE -->
  <div class="sezione">
    <div class="sezione-titolo">Bibite</div>

    <div class="piatto">
      <span class="piatto-id">#008</span>
      <div class="piatto-info">
        <div class="nome">Ayran</div>
        <div class="desc">Yogurt turco salato, freddo</div>
      </div>
      <div class="prezzo">€ 2</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#011</span>
      <div class="piatto-info">
        <div class="nome">Coca-Cola</div>
        <div class="desc">Lattina 33cl</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#012</span>
      <div class="piatto-info">
        <div class="nome">Coca-Cola Zero</div>
        <div class="desc">Lattina 33cl</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#013</span>
      <div class="piatto-info">
        <div class="nome">Fanta</div>
        <div class="desc">Lattina 33cl</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#014</span>
      <div class="piatto-info">
        <div class="nome">Sprite</div>
        <div class="desc">Lattina 33cl</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#015</span>
      <div class="piatto-info">
        <div class="nome">Acqua naturale</div>
        <div class="desc">Bottiglia 50cl</div>
      </div>
      <div class="prezzo">€ 1</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#016</span>
      <div class="piatto-info">
        <div class="nome">Acqua frizzante</div>
        <div class="desc">Bottiglia 50cl</div>
      </div>
      <div class="prezzo">€ 1</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#017</span>
      <div class="piatto-info">
        <div class="nome">Tè freddo al limone</div>
        <div class="desc">Lattina 33cl</div>
      </div>
      <div class="prezzo">€ 3</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#018</span>
      <div class="piatto-info">
        <div class="nome">Birra Efes</div>
        <div class="desc">Bottiglia 33cl</div>
      </div>
      <div class="prezzo">€ 4</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#019</span>
      <div class="piatto-info">
        <div class="nome">Birra Moretti</div>
        <div class="desc">Bottiglia 33cl</div>
      </div>
      <div class="prezzo">€ 4</div>
    </div>
  </div>

  <!-- DOLCI -->
  <div class="sezione">
    <div class="sezione-titolo">Dolci</div>

    <div class="piatto">
      <span class="piatto-id">#009</span>
      <div class="piatto-info">
        <div class="nome">Baklava</div>
        <div class="desc">Pasta sfoglia con pistacchi e sciroppo di miele (2 pezzi)</div>
      </div>
      <div class="prezzo">€ 4</div>
    </div>

    <div class="piatto">
      <span class="piatto-id">#010</span>
      <div class="piatto-info">
        <div class="nome">Künefe</div>
        <div class="desc">Pasta di semola croccante con formaggio filante e sciroppo</div>
      </div>
      <div class="prezzo">€ 6</div>
    </div>
  </div>

  <footer>
    <strong>Salse disponibili</strong><br>
    bianca · piccante · aglio · ketchup · harissa<br><br>
    I prezzi includono IVA<br>
    Informate il personale di eventuali allergie
  </footer>

</body>
</html>