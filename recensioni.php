<?php
/* ============================================================
   WALLAH KEBAB — PAGINA RECENSIONI
   PRIMA DELL'USO crea il database:

   CREATE DATABASE IF NOT EXISTS wallah_kebab CHARACTER SET utf8mb4;
   USE wallah_kebab;
   CREATE TABLE IF NOT EXISTS recensioni (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nome VARCHAR(80) NOT NULL,
     stelle TINYINT NOT NULL,
     commento TEXT NOT NULL,
     creato_il DATETIME DEFAULT CURRENT_TIMESTAMP
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
   ============================================================ */

$DB_HOST = 'mysqlkebab-wallahkebab.f.aivencloud.com';
$DB_PORT = '11837';
$DB_NAME = 'prova5';
$DB_USER = 'avnadmin';
$DB_PASS = 'AVNS_L96Vz0Si_vPBARn006w';

$errore = '';
$successo = '';

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER, $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ]
    );
} catch (PDOException $e) {
    die("Errore connessione DB: " . htmlspecialchars($e->getMessage()));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $stelle = intval($_POST['stelle'] ?? 0);
    $commento = trim($_POST['commento'] ?? '');

    if ($nome === '' || $commento === '' || $stelle < 1 || $stelle > 5) {
        $errore = 'Compila tutti i campi e seleziona da 1 a 5 stelle.';
    } elseif (mb_strlen($nome) > 80) {
        $errore = 'Il nome è troppo lungo (max 80 caratteri).';
    } elseif (mb_strlen($commento) > 1000) {
        $errore = 'Il commento è troppo lungo (max 1000 caratteri).';
    } else {
        $stmt = $pdo->prepare("INSERT INTO recensioni (nome, stelle, commento) VALUES (:n, :s, :c)");
        $stmt->execute([':n' => $nome, ':s' => $stelle, ':c' => $commento]);
        header("Location: " . $_SERVER['PHP_SELF'] . "?ok=1");
        exit;
    }
}

if (isset($_GET['ok'])) {
    $successo = 'Grazie! La tua recensione è stata pubblicata.';
}

$recensioni = $pdo->query("SELECT nome, stelle, commento, creato_il FROM recensioni ORDER BY creato_il DESC")->fetchAll(PDO::FETCH_ASSOC);
$totale = count($recensioni);
$media = 0;
if ($totale > 0) {
    $somma = array_sum(array_column($recensioni, 'stelle'));
    $media = round($somma / $totale, 1);
}

function stelle_html($n, $size = 18) {
    $out = '';
    for ($i = 1; $i <= 5; $i++) {
        $fill = $i <= $n ? '#f59e0b' : 'rgba(255,255,255,0.18)';
        $out .= '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="'.$fill.'" xmlns="http://www.w3.org/2000/svg" style="margin-right:2px"><path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
    }
    return $out;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recensioni — Wallah Kebab</title>
  <link rel="icon" type="image/png" href="kebabbazzo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,500;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="grafica.css">
  <style>
    /* ----- STILI SPECIFICI PAGINA RECENSIONI ----- */
    body {
      background-image:
        radial-gradient(1200px 600px at 80% -10%, rgba(245,158,11,0.10), transparent 60%),
        radial-gradient(900px 500px at -10% 30%, rgba(239,68,68,0.08), transparent 60%);
    }
    .hero-rec {
      padding: 140px 24px 60px; text-align: center;
      max-width: 1100px; margin: 0 auto;
    }
    .hero-rec .eyebrow {
      display: inline-block; padding: 6px 14px;
      border: 1px solid var(--card-border);
      border-radius: 999px; font-size: 0.78rem;
      letter-spacing: 2px; text-transform: uppercase;
      color: var(--accent); background: var(--accent-soft);
      margin-bottom: 18px;
    }
    .hero-rec h1 {
      font-family: 'Playfair Display', serif;
      font-style: italic; font-weight: 700;
      font-size: clamp(2.4rem, 6vw, 4.5rem);
      line-height: 1.05; margin-bottom: 14px;
    }
    .hero-rec h1 .accent { color: var(--accent); }
    .hero-rec p {
      color: var(--muted); max-width: 620px;
      margin: 0 auto; font-size: 1.05rem;
    }
    .stats {
      display: flex; justify-content: center;
      gap: 18px; margin-top: 34px; flex-wrap: wrap;
    }
    .stat-card {
      background: var(--card); border: 1px solid var(--card-border);
      border-radius: 16px; padding: 18px 26px;
      backdrop-filter: blur(14px); min-width: 170px;
    }
    .stat-card .num {
      font-size: 2rem; font-weight: 800; color: var(--accent);
      display: flex; align-items: center; gap: 8px; justify-content: center;
    }
    .stat-card .lbl {
      font-size: 0.85rem; color: var(--muted);
      letter-spacing: 1px; text-transform: uppercase;
      margin-top: 4px; text-align: center;
    }
    .wrap {
      max-width: 1200px; margin: 40px auto 80px;
      padding: 0 24px; display: grid;
      grid-template-columns: 420px 1fr; gap: 36px;
      align-items: start;
    }
    @media (max-width: 900px) { .wrap { grid-template-columns: 1fr; } }
    .form-card {
      background: var(--card); border: 1px solid var(--card-border);
      border-radius: 22px; padding: 30px;
      backdrop-filter: blur(14px); position: sticky; top: 110px;
    }
    .form-card h2 {
      font-family: 'Playfair Display', serif; font-style: italic;
      font-size: 1.7rem; margin-bottom: 6px;
    }
    .form-card .sub { color: var(--muted); font-size: 0.92rem; margin-bottom: 22px; }
    .field { margin-bottom: 18px; }
    .field label {
      display: block; font-size: 0.8rem;
      letter-spacing: 1.5px; text-transform: uppercase;
      color: var(--muted); margin-bottom: 8px;
    }
    .field input, .field textarea {
      width: 100%; background: rgba(0,0,0,0.35);
      border: 1px solid var(--card-border); border-radius: 12px;
      padding: 14px 16px; color: var(--text);
      font-family: inherit; font-size: 1rem;
      transition: border-color .2s, background .2s;
    }
    .field input:focus, .field textarea:focus {
      outline: none; border-color: var(--accent); background: rgba(0,0,0,0.5);
    }
    .field textarea { min-height: 120px; resize: vertical; }
    .star-input {
      display: flex; gap: 6px; direction: rtl; justify-content: flex-end;
    }
    .star-input input { display: none; }
    .star-input label {
      cursor: pointer; color: rgba(255,255,255,0.18);
      transition: color .15s, transform .15s;
      font-size: 32px; line-height: 1;
    }
    .star-input label:hover,
    .star-input label:hover ~ label,
    .star-input input:checked ~ label { color: var(--accent); }
    .star-input label:hover { transform: scale(1.15); }
    .submit-btn {
      width: 100%;
      background: linear-gradient(90deg, var(--accent) 0%, var(--accent-2) 100%);
      color: #1a0f00; border: none; border-radius: 12px;
      padding: 16px; font-weight: 700; font-size: 1rem;
      letter-spacing: 1.5px; text-transform: uppercase;
      cursor: pointer; transition: transform .15s, box-shadow .15s;
      margin-top: 6px;
    }
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(245, 158, 11, 0.35);
    }
    .alert {
      padding: 12px 16px; border-radius: 10px;
      margin-bottom: 18px; font-size: 0.92rem;
    }
    .alert.ok { background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.4); color: #86efac; }
    .alert.err { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.4); color: #fca5a5; }
    .lista h2 {
      font-family: 'Playfair Display', serif; font-style: italic;
      font-size: 1.8rem; margin-bottom: 22px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 18px;
    }
    .review {
      background: var(--card); border: 1px solid var(--card-border);
      border-radius: 18px; padding: 22px;
      backdrop-filter: blur(14px);
      transition: transform .25s, border-color .25s, background .25s;
      display: flex; flex-direction: column; gap: 10px;
    }
    .review:hover {
      transform: translateY(-4px);
      border-color: rgba(245,158,11,0.4);
      background: rgba(245,158,11,0.04);
    }
    .review-head { display: flex; align-items: center; gap: 12px; }
    .avatar {
      width: 42px; height: 42px; border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      color: #1a0f00; display: flex; align-items: center;
      justify-content: center; font-weight: 800; font-size: 1rem;
      flex-shrink: 0;
    }
    .review-meta { flex: 1; min-width: 0; }
    .review-meta .nome {
      font-weight: 700; font-size: 1rem;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .review-meta .data { font-size: 0.78rem; color: var(--muted); }
    .review .stars { display: flex; align-items: center; }
    .review .testo {
      color: #e8e2d6; font-size: 0.96rem;
      line-height: 1.6; word-wrap: break-word;
    }
    .vuoto {
      text-align: center; padding: 60px 20px;
      color: var(--muted);
      border: 1px dashed var(--card-border);
      border-radius: 18px;
    }
    .counter {
      font-size: 0.78rem; color: var(--muted);
      text-align: right; margin-top: 4px;
    }
    @media (max-width: 600px) {
      .hero-rec { padding-top: 110px; }
      .form-card { position: static; padding: 22px; }
      .stat-card { min-width: 140px; padding: 14px 18px; }
      .stat-card .num { font-size: 1.6rem; }
    }
  </style>
</head>
<body>

  <!-- NAV (identica a index.php) -->
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
  <section class="hero-rec">
    <span class="eyebrow">Le voci dei nostri clienti</span>
    <h1>Cosa dicono di <span class="accent">noi</span></h1>
    <p>Ogni kebab che serviamo racconta una storia. Leggi le recensioni di chi ci ha già provato — e lasciaci la tua.</p>

    <div class="stats">
      <div class="stat-card">
        <div class="num"><?= $media ?> <span style="font-size:1rem">⭐</span></div>
        <div class="lbl">Valutazione media</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= $totale ?></div>
        <div class="lbl">Recensioni totali</div>
      </div>
    </div>
  </section>

  <div class="wrap">
    <aside class="form-card">
      <h2>Lascia una recensione</h2>
      <p class="sub">Il tuo parere ci aiuta a migliorare ogni giorno.</p>

      <?php if ($errore): ?>
        <div class="alert err"><?= htmlspecialchars($errore) ?></div>
      <?php endif; ?>
      <?php if ($successo): ?>
        <div class="alert ok"><?= htmlspecialchars($successo) ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="field">
          <label for="nome">Il tuo nome</label>
          <input type="text" id="nome" name="nome" maxlength="80" placeholder="Es. Marco R." required>
        </div>

        <div class="field">
          <label>Il tuo voto</label>
          <div class="star-input">
            <input type="radio" id="s5" name="stelle" value="5" required><label for="s5">★</label>
            <input type="radio" id="s4" name="stelle" value="4"><label for="s4">★</label>
            <input type="radio" id="s3" name="stelle" value="3"><label for="s3">★</label>
            <input type="radio" id="s2" name="stelle" value="2"><label for="s2">★</label>
            <input type="radio" id="s1" name="stelle" value="1"><label for="s1">★</label>
          </div>
        </div>

        <div class="field">
          <label for="commento">La tua esperienza</label>
          <textarea id="commento" name="commento" maxlength="1000" placeholder="Raccontaci com'è andata..." required oninput="document.getElementById('cnt').textContent = this.value.length"></textarea>
          <div class="counter"><span id="cnt">0</span> / 1000</div>
        </div>

        <button type="submit" class="submit-btn">Pubblica recensione</button>
      </form>
    </aside>

    <section class="lista">
      <h2>Le ultime recensioni</h2>

      <?php if ($totale === 0): ?>
        <div class="vuoto">Ancora nessuna recensione. Sii il primo a lasciarne una!</div>
      <?php else: ?>
        <div class="grid">
          <?php foreach ($recensioni as $r):
            $iniziale = mb_strtoupper(mb_substr($r['nome'], 0, 1));
            $data = date('d/m/Y', strtotime($r['creato_il']));
          ?>
            <article class="review">
              <div class="review-head">
                <div class="avatar"><?= htmlspecialchars($iniziale) ?></div>
                <div class="review-meta">
                  <div class="nome"><?= htmlspecialchars($r['nome']) ?></div>
                  <div class="data"><?= $data ?></div>
                </div>
              </div>
              <div class="stars"><?= stelle_html((int)$r['stelle'], 16) ?></div>
              <p class="testo"><?= nl2br(htmlspecialchars($r['commento'])) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <footer>&copy; 2026 Wallah Kebab. Tutti i diritti riservati.</footer>

  <script>
    function toggleMenu() {
      document.getElementById('tenda').classList.toggle('aperta');
      document.getElementById('overlay').classList.toggle('attivo');
      document.getElementById('hamburger').classList.toggle('aperto');
    }
  </script>
</body>
</html>