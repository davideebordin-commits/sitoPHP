<!DOCTYPE html>
<html lang="it">
<link rel="stylesheet" href="grafica.css">
<head>
  <meta charset="UTF-8">
  <title>Contatti - Wallah Kebab</title>
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
      margin-top: 10px;
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
      line-height: 1.7;
    }

    .info-box a {
      color: #111;
      text-decoration: none;
      border-bottom: 1px solid #ccc;
    }

    .info-box a:hover {
      border-bottom-color: #111;
    }

    .mappa {
      margin-top: 36px;
      border-radius: 6px;
      overflow: hidden;
      border: 1px solid #ddd;
    }

    .mappa iframe {
      width: 100%;
      height: 280px;
      border: none;
      display: block;
    }
  </style>
</head>
<body>

  <button class="imageHome" onclick="window.location.href='index.php'"></button>

  <div class="header">
    <h1>Contatti</h1>
  </div>

  <div class="contenuto">

    <h2>Dove trovarci</h2>

    <p>Siamo qui per qualsiasi domanda, prenotazione o semplicemente per dirci quanto ti è piaciuto il kebab. Scrivici, chiamaci o vieni a trovarci direttamente!</p>

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

    <div class="info-griglia" style="margin-top: 30px;">

      <div class="info-box">
        <div class="etichetta">Creatore del sito</div>
        <div class="valore">Bordin Davide</div>
      </div>

      <div class="info-box">
        <div class="etichetta">Direttore Grafico</div>
        <div class="valore">Giorgio Zampieri</div>
      </div>

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

</body>
</html>