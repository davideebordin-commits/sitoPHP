<?php ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallah Kebab</title>
  <link rel="icon" type="image/png" href="kebabbazzo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="grafica.css">
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
  <section class="hero">
    <div class="hero-content">
      <span class="eyebrow">Castelfranco Veneto · Dal 2026</span>
      <h1>"<span class="accent">Wallah</span> Kebab"</h1>
      <p class="sub">Carne fresca tagliata al momento, pane caldo, sapori autentici del Medio Oriente. La tradizione che incontra il gusto.</p>
      <div class="cta-row">
        <a href="login.php" class="cta-primary">Ordina ora</a>
        <a href="menu.php" class="cta-ghost">Vedi il menu</a>
      </div>
    </div>
  </section>

  <!-- LA LOCATION -->
  <section class="section">
    <div class="section-head">
      <span class="eyebrow">Il nostro spazio</span>
      <h2>La <span class="accent">location</span></h2>
      <p>Un ambiente accogliente nel cuore di Castelfranco, dove ogni cliente è di casa.</p>
    </div>

    <div class="location-grid">
      <div class="location-img">
        <div class="bg"></div>
        <span class="tag">Interno locale</span>
      </div>
      <div class="location-info">
        <h3>Dove ci trovi</h3>
        <p>Ti aspettiamo per pranzo, cena e take-away. Aperto 7 giorni su 7.</p>
        <ul class="info-list">
          <li>
            <div class="icon">📍</div>
            <div>
              <div class="lbl">Indirizzo</div>
              <div class="val">Via dei Carpani, Castelfranco Veneto (TV)</div>
            </div>
          </li>
          <li>
            <div class="icon">🕒</div>
            <div>
              <div class="lbl">Orari</div>
              <div class="val">11:00 — 23:00 · Tutti i giorni</div>
            </div>
          </li>
          <li>
            <div class="icon">📞</div>
            <div>
              <div class="lbl">Prenotazioni</div>
              <div class="val">Chiamaci o ordina online</div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- MAPPA -->
  <section class="section" style="padding-top: 0;">
    <div class="section-head">
      <span class="eyebrow">Come arrivare</span>
      <h2>Vieni a <span class="accent">trovarci</span></h2>
    </div>
    <div class="map-wrap">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2789!2d11.9265!3d45.6732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4778116e4e4e4e4e%3A0x0!2sVia+dei+Carpani%2C+Castelfranco+Veneto%2C+TV!5e0!3m2!1sit!2sit!4v1"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

  <!-- VIDEO -->
  <section class="hero4">
    <video autoplay muted loop playsinline class="hero4-video">
      <source src="video/kebb.mp4" type="video/mp4">
    </video>
    <div class="hero4-overlay"></div>
    <div class="hero4-contenuto">
      <h4>Carne fresca, <span class="accent">sapori autentici</span></h4>
      <p>Selezioniamo ogni giorno le migliori materie prime per offrirti un kebab che ricorderai.</p>
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