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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Nuovo Ordine - Wallah Kebab</title>

  <link rel="stylesheet" href="grafica.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    :root{
      --nero:#111;
      --bianco:#fff;
      --grigio:#f5f5f3;
      --bordo:#e0e0de;
      --grigio2:#999;
      --accent:#c0392b;
    }

    body{
      font-family:'DM Sans',sans-serif;
      background:var(--grigio);
      color:var(--nero);
      min-height:100vh;
      padding-bottom:180px;
      -webkit-font-smoothing:antialiased;
    }

    /* HEADER */

    .header{
      background:var(--nero);
      color:var(--bianco);
      padding:18px 60px 18px 70px;
      display:flex;
      align-items:center;
      position:sticky;
      top:0;
      z-index:100;
    }

    .header h2{
      font-family:'Playfair Display',serif;
      font-size:1rem;
      font-style:italic;
      font-weight:400;
      letter-spacing:1px;
    }

    /* HOME BUTTON */

    .imageHome{
      background-image:url('kebabbazzo.png');
      background-size:contain;
      background-repeat:no-repeat;
      background-color:transparent;
      position:fixed;
      top:14px;
      left:15px;
      width:42px;
      height:42px;
      border:none;
      cursor:pointer;
      z-index:9999;
    }

    /* CONTENITORE */

    .menu-container{
      max-width:560px;
      margin:0 auto;
      padding:16px;
    }

    /* TITOLI */

    .menu-section-title{
      font-size:0.68rem;
      font-weight:500;
      letter-spacing:3px;
      text-transform:uppercase;
      color:var(--grigio2);
      border-bottom:1px solid var(--bordo);
      padding-bottom:8px;
      margin:24px 0 10px;
    }

    /* CARD */

    .piatto-card{
      background:var(--bianco);
      border:1px solid var(--bordo);
      border-radius:10px;
      padding:14px;
      margin-bottom:8px;
      display:flex;
      align-items:center;
      gap:10px;
      transition:0.2s;
    }

    .piatto-card.attivo{
      border-color:var(--nero);
      box-shadow:0 2px 12px rgba(0,0,0,0.1);
    }

    .piatto-id{
      font-size:9px;
      font-weight:500;
      color:var(--grigio2);
      background:var(--grigio);
      border:1px solid var(--bordo);
      border-radius:3px;
      padding:2px 5px;
      white-space:nowrap;
    }

    .piatto-info{
      flex:1;
      min-width:0;
    }

    .nome{
      font-weight:500;
      font-size:0.9rem;
      line-height:1.3;
    }

    .desc{
      font-size:0.75rem;
      color:#777;
      margin-top:2px;
      line-height:1.3;
    }

    .prezzo{
      font-weight:500;
      white-space:nowrap;
      font-size:0.9rem;
    }

    /* QUANTITA */

    .qty-control{
      display:flex;
      align-items:center;
      gap:6px;
    }

    .qty-btn{
      width:34px;
      height:34px;
      border:2px solid var(--nero);
      background:var(--bianco);
      border-radius:50%;
      font-size:1.1rem;
      font-weight:bold;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      transition:0.15s;
    }

    .qty-btn:hover{
      background:var(--nero);
      color:var(--bianco);
    }

    .qty-display{
      width:22px;
      text-align:center;
      font-weight:600;
    }

    /* CARRELLO */

    .carrello-fisso{
      position:fixed;
      bottom:0;
      left:0;
      right:0;
      background:var(--nero);
      color:var(--bianco);
      z-index:200;
      padding:16px 20px 20px;
      max-width:560px;
      margin:0 auto;
    }

    @media (min-width:560px){
      .carrello-fisso{
        left:50%;
        right:auto;
        transform:translateX(-50%);
        width:560px;
        border-radius:12px 12px 0 0;
      }
    }

    .carrello-header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:10px;
      cursor:pointer;
    }

    .carrello-titolo{
      font-size:0.68rem;
      letter-spacing:3px;
      text-transform:uppercase;
      color:#aaa;
    }

    .carrello-toggle{
      font-size:0.75rem;
      color:#aaa;
    }

    .carrello-lista-wrap{
      overflow:hidden;
      max-height:0;
      transition:max-height 0.3s ease;
    }

    .carrello-lista-wrap.aperto{
      max-height:300px;
    }

    #lista-riepilogo{
      list-style:none;
      border-bottom:1px solid #333;
      margin-bottom:10px;
      padding-bottom:8px;
    }

    #lista-riepilogo li{
      display:flex;
      justify-content:space-between;
      padding:5px 0;
      font-size:0.85rem;
      border-bottom:1px solid #2a2a2a;
    }

    .msg-vuoto{
      color:#666;
      font-style:italic;
    }

    /* NOTE */

    .note-wrapper{
      padding:10px 0 12px;
    }

    .note-label{
      display:block;
      font-size:0.68rem;
      letter-spacing:2px;
      text-transform:uppercase;
      color:#aaa;
      margin-bottom:6px;
    }

    .note-textarea{
      width:100%;
      background:#1a1a1a;
      border:1px solid #444;
      border-radius:6px;
      color:#fff;
      font-size:0.85rem;
      padding:10px 12px;
      resize:none;
      height:60px;
      outline:none;
    }

    .note-counter{
      text-align:right;
      font-size:0.7rem;
      color:#555;
      margin-top:3px;
    }

    /* FOOTER */

    .carrello-bottom{
      display:flex;
      align-items:center;
      gap:12px;
      margin-top:4px;
    }

    .totale-label{
      font-size:1rem;
      font-weight:600;
      white-space:nowrap;
    }

    .totale-label span:first-child{
      font-size:0.75rem;
      color:#aaa;
      margin-right:4px;
    }

    .bottone-conferma{
      flex:1;
      background:var(--accent);
      color:var(--bianco);
      font-size:0.9rem;
      font-weight:500;
      letter-spacing:2px;
      text-transform:uppercase;
      padding:14px 10px;
      border:none;
      border-radius:6px;
      cursor:pointer;
      transition:0.2s;
    }

    .bottone-conferma:hover{
      background:#a93226;
    }

    .bottone-conferma:disabled{
      background:#333;
      color:#666;
      cursor:not-allowed;
    }
  </style>
</head>

<body>

  <button class="imageHome" onclick="window.location.href='index.php'"></button>

  <div class="header">
    <h2>Ordine — <?= htmlspecialchars($nomeutente) ?></h2>
  </div>

  <div class="menu-container">

    <div class="menu-section-title">Kebab & Wrap</div>

    <?php
    $menu = [
      ["001","Kebab nel pane","Pita, carne mista, insalata, pomodoro, cipolla e salsa","6"],
      ["002","Durum wrap","Pane yufka, carne, verdure grigliate e salsa piccante","7"],
      ["003","Kebab box","Carne su riso basmati con insalata e salsa bianca","9"],
      ["004","Lahmacun","Pizza turca sottile con carne speziata e limone","7"],
      ["005","Pide con carne","Barca di pane con carne e formaggio","9"],
      ["006","Pollo alla griglia","Petto marinato con spezie turche","10"],
      ["007","Patatine fritte","Croccanti con salsa","3"],
      ["008","Ayran","Yogurt turco salato","2"],
      ["009","Baklava","Pasta sfoglia con pistacchi","4"],
      ["010","Künefe","Pasta croccante con formaggio filante","6"]
    ];

    foreach($menu as $item){
      echo '
      <div class="piatto-card" data-id="'.$item[0].'">

        <span class="piatto-id">#'.$item[0].'</span>

        <div class="piatto-info">
          <div class="nome">'.$item[1].'</div>
          <div class="desc">'.$item[2].'</div>
        </div>

        <div class="prezzo">€ '.$item[3].'</div>

        <div class="qty-control">
          <button class="qty-btn" onclick="cambia(this,-1)">−</button>
          <span class="qty-display">0</span>
          <button class="qty-btn" onclick="cambia(this,1)">+</button>
        </div>

      </div>';
    }
    ?>

  </div>

  <!-- CARRELLO -->

  <div class="carrello-fisso">

    <div class="carrello-header" onclick="toggleCarrello()">
      <span class="carrello-titolo">Il tuo ordine</span>
      <span class="carrello-toggle" id="toggle-label">
        ▲ vedi dettaglio
      </span>
    </div>

    <div class="carrello-lista-wrap" id="carrello-lista">

      <ul id="lista-riepilogo">
        <li>
          <span class="msg-vuoto">
            Nessun articolo selezionato
          </span>
        </li>
      </ul>

      <div class="note-wrapper">

        <label class="note-label">
          Note extra
        </label>

        <textarea
          id="note-extra"
          class="note-textarea"
          maxlength="300"
          placeholder="Es: senza cipolla, extra salsa piccante..."
        ></textarea>

        <div class="note-counter">
          <span id="note-count">0</span>/300
        </div>

      </div>

    </div>

    <div class="carrello-bottom">

      <div class="totale-label">
        <span>Totale</span>
        <span id="totale">€ 0</span>
      </div>

      <button
        class="bottone-conferma"
        id="btn-conferma"
        disabled
        onclick="confermaOrdine()"
      >
        Conferma
      </button>

    </div>

  </div>

  <script>

    let carrelloAperto = false;

    function toggleCarrello(){

      carrelloAperto = !carrelloAperto;

      const wrap = document.getElementById('carrello-lista');
      const label = document.getElementById('toggle-label');

      wrap.classList.toggle('aperto', carrelloAperto);

      label.textContent =
        carrelloAperto
        ? '▼ chiudi'
        : '▲ vedi dettaglio';
    }

    function cambia(btn, delta){

      const card = btn.closest('.piatto-card');

      const display = card.querySelector('.qty-display');

      let qty = parseInt(display.textContent) + delta;

      if(qty < 0) qty = 0;

      display.textContent = qty;

      card.classList.toggle('attivo', qty > 0);

      aggiornaRiepilogo();
    }

    function aggiornaRiepilogo(){

      const cards = document.querySelectorAll('.piatto-card');

      const lista = document.getElementById('lista-riepilogo');

      const totaleEl = document.getElementById('totale');

      const btnConferma = document.getElementById('btn-conferma');

      lista.innerHTML = '';

      let totale = 0;
      let haVoci = false;

      cards.forEach(card => {

        const qty = parseInt(
          card.querySelector('.qty-display').textContent
        );

        if(qty > 0){

          haVoci = true;

          const nome =
            card.querySelector('.nome').textContent;

          const prezzo =
            parseFloat(
              card.querySelector('.prezzo')
              .textContent
              .replace('€','')
              .trim()
            );

          const sub = prezzo * qty;

          totale += sub;

          const li = document.createElement('li');

          li.innerHTML =
            `<span>${qty}× ${nome}</span>
             <span>€ ${sub.toFixed(0)}</span>`;

          lista.appendChild(li);
        }
      });

      if(!haVoci){

        lista.innerHTML =
          '<li><span class="msg-vuoto">Nessun articolo selezionato</span></li>';
      }

      totaleEl.textContent = '€ ' + totale.toFixed(0);

      btnConferma.disabled = !haVoci;

      if(haVoci && !carrelloAperto){
        toggleCarrello();
      }
    }

    /* NOTE */

    const noteEl = document.getElementById('note-extra');

    const noteCount = document.getElementById('note-count');

    noteEl.addEventListener('input', () => {
      noteCount.textContent = noteEl.value.length;
    });

    /* INVIO */

    function confermaOrdine(){

      const note =
        document.getElementById('note-extra')
        .value
        .trim();

      const dati = [];

      document.querySelectorAll('.piatto-card').forEach(card => {

        const qty = parseInt(
          card.querySelector('.qty-display').textContent
        );

        if(qty > 0){

          dati.push({

            id: card.dataset.id,

            nome:
              card.querySelector('.nome').textContent,

            prezzo:
              parseFloat(
                card.querySelector('.prezzo')
                .textContent
                .replace('€','')
                .trim()
              ),

            qty: qty
          });
        }
      });

      fetch('salva_ordine.php', {

        method:'POST',

        headers:{
          'Content-Type':'application/json'
        },

        body:JSON.stringify({
          voci:dati,
          note:note
        })

      })
      .then(res => res.json())

      .then(data => {

        if(data.ok){

          window.location.href = 'pagamento.php';

        }else{

          alert(
            'Errore nel salvataggio ordine'
          );
        }
      })

      .catch(() => {

        alert('Errore di rete');
      });
    }

  </script>

</body>
</html>