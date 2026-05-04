<php>

</php>
<html>

<link rel="stylesheet" href="grafica.css">

<head>
 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallah Kebab</title>

  <link rel="stylesheet" href="grafica.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="kebabbazzo.png">

</head>

<body>

  <div class="hero">

    <h1 class="testo">"Wallah Kebab"</h1>
    <button class="imageHome" onclick="window.location.href='index.php'"></button>
    <button class="imageHomeCentrale" onclick="window.location.href='login.php'"></button>

  </div>


  <div class="hero2" style="
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 30px;
">

    <h1 style="color:white; font-style:italic; font-size:4.5em; text-align:center; margin:0;">
      LA LOCATION
    </h1>

  </div>

  <div class="hero3" style="
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 30px;
">
    <div>
      <h3>VIENI A TROVARCI</h3>
    </div>


   
    <div class="mappaHome">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2789!2d11.9265!3d45.6732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4778116e4e4e4e4e%3A0x0!2sVia+dei+Carpani%2C+Castelfranco+Veneto%2C+TV!5e0!3m2!1sit!2sit!4v1"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
    <div>
      <button class="imageRettangoloHero3"></button>

    </div>
  </div>



  <section class="hero4">
  <video autoplay muted loop playsinline class="hero4-video">
    <source src="video/kebb.mp4" type="video/mp4">
  </video>
  <div class="hero4-overlay"></div>
  <div class="hero4-contenuto">
     
    <h4>Carne fresca, sapori autentici</h4>
   
  </div>

</section>




  <div class="hamburger" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>




  <div class="tenda" id="tenda">
    <button class="chiudi" onclick="toggleMenu()">✕</button>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="contatti.php">Contatti</a>
      <a href="chisiamo.php">Chi siamo</a>
      <a href="login.php">Ordina QUI</a>
      <a href="recensioni.php">Recensioni dei Clienti</a>



    </nav>
  </div>


  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <script>
    function toggleMenu() {
      document.getElementById('tenda').classList.toggle('aperta');
      document.getElementById('overlay').classList.toggle('attivo');
    }
  </script>



</body>



<footer>
  <p style="text-align: center; color: #888; font-size: 0.9em; margin-top: 40px;">
    &copy; 2026  Wallah Kebab. Tutti i diritti riservati.
  </p>
</footer>


</html>