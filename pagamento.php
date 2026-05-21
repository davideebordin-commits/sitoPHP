<?php
session_start();

if (!isset($_SESSION['nomeutente'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['ordine']) || empty($_SESSION['ordine'])) {
    header("Location: ordine.php");
    exit;
}

$nomeutente  = $_SESSION['nomeutente'];
$ordine      = $_SESSION['ordine'];
$totale      = $_SESSION['totale'];
$descrizione = $_SESSION['descrizione'];
$note_ordine = $_SESSION['note_ordine'] ?? '';

$host     = "mysqlkebab-wallahkebab.f.aivencloud.com";
$port     = "11837";
$user     = "avnadmin";
$password = "AVNS_L96Vz0Si_vPBARn006w";
$db       = "prova5";
$dsn      = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
$options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

$errore        = "";
$successo      = false;
$carta_salvata = "";

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    $stmt = $pdo->prepare("SELECT numeroCarta FROM utente WHERE nome = :nome");
    $stmt->execute([':nome' => $nomeutente]);
    $row = $stmt->fetch();
    if ($row && !empty($row['numeroCarta'])) {
        $carta_salvata = $row['numeroCarta'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero_carta = preg_replace('/\s+/', '', $_POST['numero_carta'] ?? '');
        $scadenza     = trim($_POST['scadenza'] ?? '');
        $cvv          = trim($_POST['cvv']      ?? '');
        $salva_carta  = isset($_POST['salva_carta']);

        if (strlen($numero_carta) !== 16 || !ctype_digit($numero_carta)) {
            $errore = "Numero carta non valido. Inserisci 16 cifre.";
        } elseif (!preg_match('/^\d{2}\/\d{2}$/', $scadenza)) {
            $errore = "Data di scadenza non valida. Formato: MM/AA";
        } elseif (strlen($cvv) !== 3 || !ctype_digit($cvv)) {
            $errore = "CVV non valido. Deve essere di 3 cifre.";
        } else {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare(
                "INSERT INTO ordine (nomeUtente, descrizioneOrdine, costoOrdine, data)
                 VALUES (:utente, :descr, :costo, NOW())"
            );
            $stmt->execute([
                ':utente' => $nomeutente,
                ':descr'  => $descrizione,
                ':costo'  => $totale,
            ]);
            $idOrdine = $pdo->lastInsertId();

            $stmt2 = $pdo->prepare(
                "INSERT INTO dettaglioordine (idOrdine, nome_piatto, idPiatto, qty, noteExtraOrdine)
                 VALUES (:idOrdine, :nome, :idPiatto, :qty, :note)"
            );
            foreach ($ordine as $voce) {
                $stmt2->execute([
                    ':idOrdine' => $idOrdine,
                    ':nome'     => $voce['nome'],
                    ':idPiatto' => $voce['id'],
                    ':qty'      => $voce['qty'],
                    ':note'     => $note_ordine,
                ]);
            }

            if ($salva_carta) {
                $stmt3 = $pdo->prepare(
                    "UPDATE utente SET numeroCarta = :carta WHERE nome = :nome"
                );
                $stmt3->execute([':carta' => $numero_carta, ':nome' => $nomeutente]);
            }

            $pdo->commit();

            unset($_SESSION['ordine'], $_SESSION['totale'], $_SESSION['descrizione'], $_SESSION['note_ordine']);
            $successo = true;
        }
    }

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) $pdo->rollBack();
    $errore = "Errore database: " . $e->getMessage();
}

$carta_display = "";
if ($carta_salvata) {
    $carta_display = str_repeat('•', 12) . substr($carta_salvata, -4);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagamento - Wallah Kebab</title>
  <link rel="stylesheet" href="grafica.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --nero: #111;
      --bianco: #fff;
      --grigio-chiaro: #f5f5f3;
      --bordo: #e0e0e0;
      --grigio-medio: #999;
      --accent: #c0392b;
    }

    body {
      font-family: 'DM Sans', Georgia, serif;
      background: var(--grigio-chiaro);
      color: var(--nero);
      min-height: 100vh;
      padding-bottom: 60px;
      -webkit-font-smoothing: antialiased;
    }

    /* HEADER */
    .header {
      background: var(--nero);
      color: var(--bianco);
      padding: 18px 60px 18px 70px;
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-style: italic;
      font-weight: 400;
      color: var(--bianco);
      letter-spacing: 1px;
    }

    /* LOGO */
    .imageHome {
      background-image: url('kebabbazzo.png');
      background-size: contain;
      background-repeat: no-repeat;
      background-color: transparent;
      position: fixed;
      top: 14px;
      left: 15px;
      width: 42px;
      height: 42px;
      border: none;
      outline: none;
      padding: 0;
      cursor: pointer;
      z-index: 9999;
    }

    /* CONTENITORE */
    .page-wrap {
      max-width: 520px;
      margin: 0 auto;
      padding: 20px 16px;
    }

    /* CARD */
    .card {
      background: var(--bianco);
      border: 1px solid var(--bordo);
      border-radius: 10px;
      padding: 22px 18px;
      margin-bottom: 16px;
    }

    .card-title {
      font-size: 0.68rem;
      font-weight: 500;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--grigio-medio);
      border-bottom: 1px solid var(--bordo);
      padding-bottom: 10px;
      margin-bottom: 18px;
    }

    /* RIEPILOGO */
    .riepilogo-lista {
      list-style: none;
    }

    .riepilogo-lista li {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      padding: 9px 0;
      font-size: 0.92rem;
      border-bottom: 1px solid #f0ede8;
      gap: 8px;
    }

    .riepilogo-lista li:last-child {
      border-bottom: none;
    }

    .voce-sinistra {
      display: flex;
      align-items: baseline;
      gap: 5px;
      min-width: 0;
    }

    .voce-nome {
      color: #333;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .voce-qty {
      color: var(--grigio-medio);
      font-size: 0.82rem;
      flex-shrink: 0;
    }

    .voce-prezzo {
      font-weight: 500;
      flex-shrink: 0;
      font-size: 0.92rem;
    }

    .totale-row {
      display: flex;
      justify-content: space-between;
      font-weight: 600;
      font-size: 1.05rem;
      margin-top: 14px;
      padding-top: 12px;
      border-top: 2px solid var(--nero);
    }

    .note-riepilogo {
      margin-top: 14px;
      padding-top: 12px;
      border-top: 1px dashed #ddd;
    }

    .note-label {
      font-size: 0.68rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #aaa;
      margin-bottom: 5px;
    }

    .note-testo {
      font-size: 0.85rem;
      color: #555;
      font-style: italic;
      line-height: 1.5;
    }

    /* FORM */
    .icone-carte {
      display: flex;
      gap: 8px;
      margin-bottom: 18px;
    }

    .icona-carta {
      background: var(--nero);
      color: var(--bianco);
      font-size: 0.65rem;
      font-weight: bold;
      letter-spacing: 1px;
      padding: 4px 9px;
      border-radius: 4px;
      opacity: 0.5;
    }

    .carta-salvata-notice {
      background: #f0ede8;
      border: 1px solid #d8d4cd;
      border-radius: 6px;
      padding: 11px 14px;
      font-size: 0.85rem;
      color: #555;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .usa-salvata {
      background: var(--nero);
      color: var(--bianco);
      border: none;
      border-radius: 4px;
      padding: 6px 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.8rem;
      cursor: pointer;
      letter-spacing: 1px;
      flex-shrink: 0;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 0.72rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--grigio-medio);
      margin-bottom: 6px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 13px 14px;
      border: 1px solid var(--bordo);
      border-radius: 6px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      background: #faf9f7;
      transition: border-color 0.2s;
      outline: none;
      min-height: 48px;
    }

    .form-group input:focus {
      border-color: var(--nero);
      background: var(--bianco);
    }

    .row-due {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .check-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
      font-size: 0.88rem;
      color: #555;
      padding: 12px 0;
      border-top: 1px solid var(--bordo);
    }

    .check-row input[type="checkbox"] {
      width: 20px;
      height: 20px;
      accent-color: var(--nero);
      cursor: pointer;
      flex-shrink: 0;
    }

    .btn-paga {
      display: block;
      width: 100%;
      background: var(--accent);
      color: var(--bianco);
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s;
      min-height: 52px;
    }

    .btn-paga:hover,
    .btn-paga:active {
      background: #a93226;
    }

    .msg-errore {
      background: #fff0f0;
      border: 1px solid #e8b4b4;
      color: #c00;
      border-radius: 6px;
      padding: 12px 14px;
      margin-bottom: 18px;
      font-size: 0.88rem;
      line-height: 1.5;
    }

    .sicuro-label {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-size: 0.74rem;
      color: #aaa;
      margin-top: 14px;
      letter-spacing: 0.5px;
      text-align: center;
    }

    /* SUCCESSO */
    .successo-box {
      max-width: 360px;
      margin: 60px auto;
      padding: 0 20px;
      text-align: center;
    }

    .check-icon {
      width: 68px;
      height: 68px;
      background: var(--nero);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      font-size: 1.8rem;
      color: var(--bianco);
    }

    .successo-box h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      font-style: italic;
      margin-bottom: 12px;
    }

    .successo-box p {
      color: #666;
      line-height: 1.7;
      margin-bottom: 28px;
      font-size: 0.95rem;
    }

    .btn-home {
      display: inline-block;
      background: var(--nero);
      color: var(--bianco);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.88rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 14px 32px;
      border: 2px solid var(--nero);
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s, color 0.2s;
    }

    .btn-home:hover {
      background: var(--bianco);
      color: var(--nero);
    }
  </style>
</head>
<body>

  <button class="imageHome" onclick="window.location.href='index.php'"></button>

  <div class="header">
    <h2>Pagamento — <?= htmlspecialchars($nomeutente) ?></h2>
  </div>

  <?php if ($successo): ?>

  <div class="successo-box">
    <div class="check-icon">✓</div>
    <h2>Ordine confermato!</h2>
    <p>
      Grazie <?= htmlspecialchars($nomeutente) ?>, il tuo ordine è stato ricevuto.<br>
      Prepareremo tutto a breve. Buon appetito!
    </p>
    <a href="index.php" class="btn-home">Torna alla home</a>
  </div>

  <?php else: ?>

  <div class="page-wrap">

    <!-- Riepilogo ordine -->
    <div class="card">
      <div class="card-title">Il tuo ordine</div>
      <ul class="riepilogo-lista">
        <?php foreach ($ordine as $v): ?>
          <li>
            <span class="voce-sinistra">
              <span class="voce-nome"><?= htmlspecialchars($v['nome']) ?></span>
              <span class="voce-qty">×<?= (int)$v['qty'] ?></span>
            </span>
            <span class="voce-prezzo">€ <?= number_format($v['prezzo'] * $v['qty'], 0) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="totale-row">
        <span>Totale</span>
        <span>€ <?= number_format($totale, 0) ?></span>
      </div>

      <?php if (!empty($note_ordine)): ?>
      <div class="note-riepilogo">
        <div class="note-label">📝 Note</div>
        <div class="note-testo"><?= htmlspecialchars($note_ordine) ?></div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Form pagamento -->
    <div class="card">
      <div class="card-title">Dati di pagamento</div>

      <?php if ($errore): ?>
        <div class="msg-errore"><?= htmlspecialchars($errore) ?></div>
      <?php endif; ?>

      <?php if ($carta_salvata): ?>
        <div class="carta-salvata-notice">
          <span>Carta salvata: <strong><?= htmlspecialchars($carta_display) ?></strong></span>
          <button type="button" class="usa-salvata" onclick="usaCarta()">Usa questa</button>
        </div>
      <?php endif; ?>

      <div class="icone-carte">
        <span class="icona-carta">VISA</span>
        <span class="icona-carta">MC</span>
        <span class="icona-carta">AMEX</span>
      </div>

      <form method="POST" action="">
        <div class="form-group">
          <label for="numero_carta">Numero carta</label>
          <input type="text" id="numero_carta" name="numero_carta" maxlength="19"
                 placeholder="0000 0000 0000 0000" autocomplete="cc-number" inputmode="numeric"
                 value="<?= htmlspecialchars($_POST['numero_carta'] ?? '') ?>">
        </div>
        <div class="row-due">
          <div class="form-group">
            <label for="scadenza">Scadenza</label>
            <input type="text" id="scadenza" name="scadenza" maxlength="5"
                   placeholder="MM/AA" autocomplete="cc-exp"
                   value="<?= htmlspecialchars($_POST['scadenza'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="password" id="cvv" name="cvv" maxlength="3"
                   placeholder="•••" autocomplete="cc-csc" inputmode="numeric">
          </div>
        </div>
        <div class="check-row">
          <input type="checkbox" id="salva_carta" name="salva_carta">
          <label for="salva_carta">Salva questa carta per i prossimi ordini</label>
        </div>
        <button type="submit" class="btn-paga">
          Paga € <?= number_format($totale, 0) ?>
        </button>
      </form>

      <div class="sicuro-label">
        <span>🔒</span>
        <span>Pagamento simulato — nessun dato reale trasmesso</span>
      </div>
    </div>

  </div>

  <?php endif; ?>

  <script>
    const inputCarta = document.getElementById('numero_carta');
    if (inputCarta) {
      inputCarta.addEventListener('input', function () {
        let v = this.value.replace(/\D/g, '').slice(0, 16);
        this.value = v.replace(/(.{4})/g, '$1 ').trim();
      });
    }
    const inputScad = document.getElementById('scadenza');
    if (inputScad) {
      inputScad.addEventListener('input', function () {
        let v = this.value.replace(/\D/g, '').slice(0, 4);
        if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
        this.value = v;
      });
    }
    function usaCarta() {
      document.getElementById('numero_carta').value =
        '<?= addslashes($carta_salvata) ?>'.replace(/(.{4})/g, '$1 ').trim();
    }
  </script>

</body>
</html>