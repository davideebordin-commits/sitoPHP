<!DOCTYPE html>
<html lang="it">
<link rel="stylesheet" href="grafica.css">
<head>
  <meta charset="UTF-8">
  <title>Chi Siamo - Wallah Kebab</title>
  <style>
    body {
      font-family: Georgia, serif;
      background: #f7f5f0;
      color: #222;
      margin: 0;
      padding-bottom: 60px;
    }

    .header {
      background: #111;
      color: #fff;
      padding: 18px 25px 18px 120px;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header h1 {
      font-size: 1.3em;
      font-style: italic;
      letter-spacing: 1px;
      text-align: left;
      color: #fff;
    }

    .contenuto {
      max-width: 650px;
      margin: 50px auto;
      padding: 0 24px;
    }

    .contenuto h2 {
      font-size: 1.8em;
      font-style: italic;
      border-bottom: 2px solid #111;
      padding-bottom: 10px;
      margin-bottom: 24px;
      text-align: left;
    }

    .contenuto p {
      font-size: 1.05em;
      line-height: 1.9;
      color: #444;
      margin-bottom: 20px;
    }

    .divider {
      width: 50px;
      height: 3px;
      background: #111;
      margin: 30px 0;
    }

    .info-griglia {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      margin-top: 30px;
    }

    .info-box {
      flex: 1;
      min-width: 180px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 20px;
    }

    .info-box .etichetta {
      font-size: 0.75em;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #888;
      margin-bottom: 8px;
    }

    .info-box .valore {
      font-size: 1em;
      font-weight: bold;
      color: #111;
    }
  </style>
</head>
<body>

  <button class="imageHome" onclick="window.location.href='schermataIniziale.php'"></button>

  <div class="header">
    <h1>Chi Siamo</h1>
  </div>

  <div class="contenuto">

    <h2>Wallah Kebab</h2>

    <p>Benvenuti su Wallah Kebab, il vostro punto di riferimento per il miglior kebab della città! Siamo appassionati di cucina e ci impegniamo a offrire un'esperienza culinaria autentica e deliziosa.</p>

    <p>La nostra missione è portare i sapori tradizionali del Medio Oriente direttamente nel vostro piatto, utilizzando ingredienti freschi e di alta qualità. Che siate amanti del kebab classico o alla ricerca di nuove varianti, da noi troverete sempre qualcosa di speciale da gustare.</p>

    <p>Grazie per essere parte della nostra famiglia di amanti del kebab!</p>

    <div class="divider"></div>

    <div class="info-griglia">
      <div class="info-box">
        <div class="etichetta">Orari</div>
        <div class="valore">Lun – Dom<br>12:00 – 23:00</div>
      </div>
      <div class="info-box">
        <div class="etichetta">Dove siamo</div>
        <div class="valore">Via Dae Baeotte<br>Castelfranco (TV)</div>
      </div>
      <div class="info-box">
        <div class="etichetta">Contatti</div>
        <div class="valore">+39 000 000 0000</div>
      </div>
    </div>

  </div>

</body>
</html>