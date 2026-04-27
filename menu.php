<!DOCTYPE html>
<html lang="it">
<link rel="stylesheet" href="grafica.css">

<head>
  <meta charset="UTF-8">
  <title>Menu - Wallah Kebab </title>
  <style>
    body {
      font-family: Georgia, serif;
      max-width: 600px;
      margin: 40px auto;
      padding: 0 20px;
      color: #222;
      background: #fff;
    }

    h1 {
      text-align: center;
      font-size: 2em;
      margin-bottom: 5px;
    }

    .sottotitolo {
      text-align: center;
      color: #666;
      margin-bottom: 30px;
      font-style: italic;
    }

    h2 {
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
      margin-top: 30px;
      font-size: 1.2em;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .piatto {
      display: flex;
      align-items: flex-start;
      margin: 12px 0;
      gap: 12px;
    }

    .piatto-id {
      font-size: 11px;
      font-weight: bold;
      color: #888;
      background: #f5f5f5;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 2px 7px;
      white-space: nowrap;
      flex-shrink: 0;
      margin-top: 3px;
    }

    .piatto-info {
      flex: 1;
    }

    .piatto-info .nome {
      font-weight: bold;
    }

    .piatto-info .desc {
      font-size: 0.9em;
      color: #555;
    }

    .prezzo {
      font-weight: bold;
      white-space: nowrap;
      margin-left: 15px;
      flex-shrink: 0;
      margin-top: 2px;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.85em;
      color: #999;
      border-top: 1px solid #eee;
      padding-top: 15px;
    }
  </style>
</head>

<body>
  <div>
    <button class="bottone3" onclick="window.location.href='login.php'">Ordina Qui</button>
  </div>
  <h1>Wallah Kebab</h1>
  <p class="sottotitolo">er mejo</p>

  <h2>Kebab &amp; Wrap</h2>

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

  <h2>Piatti Caldi</h2>

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

  <h2>Contorni &amp; Bevande</h2>

  <div class="piatto">
    <span class="piatto-id">#007</span>
    <div class="piatto-info">
      <div class="nome">Patatine fritte</div>
      <div class="desc">Croccanti, con salsa a scelta</div>
    </div>
    <div class="prezzo">€ 3</div>
  </div>

  <div class="piatto">
    <span class="piatto-id">#008</span>
    <div class="piatto-info">
      <div class="nome">Ayran</div>
      <div class="desc">Yogurt turco salato, freddo</div>
    </div>
    <div class="prezzo">€ 2</div>
  </div>

  <h2>Dolci</h2>

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

  <footer>
    Salse: bianca · piccante · aglio · ketchup · harissa<br>
    I prezzi includono IVA · Informate il personale di eventuali allergie
  </footer>

</body>

</html>