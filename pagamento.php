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

$host     = "localhost";
$user     = "root";
$password = "";
$db       = "prova5";
$dsn      = "mysql:host=$host;dbname=$db;charset=utf8";
$options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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

            // 1. Inserisci ordine  
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

            // 2. Inserisci dettagli  ordine
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

            // 3. Salva carta se richiesto
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
  <title>Pagamento - Wallah Kebab</title>
  <link rel="stylesheet" href="grafica.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Georgia, serif; background: #f7f5f0; color: #222; min-height: 100vh; padding-bottom: 80px; }
    .header { background: #111; color: #fff; padding: 18px 25px 18px 120px; display: flex; align-items: center; position: sticky; top: 0; z-index: 100; }
    .header h2 { font-size: 1.3em; font-style: italic; letter-spacing: 1px; color: #fff; border: none; }
    .page-grid { max-width: 860px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 28px; }
    @media (max-width: 620px) { .page-grid { grid-template-columns: 1fr; } }
    .card { background: #fff; border: 1px solid #e0ddd8; border-radius: 8px; padding: 28px 24px; }
    .card-title { font-size: 0.78em; font-weight: bold; letter-spacing: 3px; text-transform: uppercase; color: #888; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
    .riepilogo-lista { list-style: none; }
    .riepilogo-lista li { display: flex; justify-content: space-between; padding: 7px 0; font-size: 0.9em; border-bottom: 1px solid #f0ede8; }
    .riepilogo-lista li:last-child { border-bottom: none; }
    .voce-nome { color: #333; }
    .voce-qty  { color: #999; font-size: 0.85em; margin-left: 4px; }
    .totale-row { display: flex; justify-content: space-between; font-weight: bold; font-size: 1.05em; margin-top: 16px; padding-top: 12px; border-top: 2px solid #111; }

    /* Note nel riepilogo */
    .note-riepilogo { margin-top: 16px; padding-top: 14px; border-top: 1px dashed #ddd; }
    .note-riepilogo-label { font-size: 0.72em; letter-spacing: 2px; text-transform: uppercase; color: #aaa; margin-bottom: 5px; }
    .note-riepilogo-testo { font-size: 0.88em; color: #555; font-style: italic; line-height: 1.5; }

    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 0.8em; letter-spacing: 1px; text-transform: uppercase; color: #888; margin-bottom: 6px; }
    .form-group input[type="text"], .form-group input[type="password"] { width: 100%; padding: 11px 14px; border: 1px solid #d0cdc8; border-radius: 4px; font-family: Georgia, serif; font-size: 1em; background: #faf9f7; transition: border-color 0.2s; outline: none; }
    .form-group input:focus { border-color: #111; background: #fff; }
    .row-due { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .carta-salvata-notice { background: #f0ede8; border: 1px solid #d8d4cd; border-radius: 4px; padding: 10px 14px; font-size: 0.88em; color: #555; margin-bottom: 18px; display: flex; align-items: center; justify-content: space-between; gap: 10px; }
    .usa-salvata { background: #111; color: #fff; border: none; border-radius: 3px; padding: 5px 12px; font-family: Georgia, serif; font-size: 0.82em; cursor: pointer; letter-spacing: 1px; flex-shrink: 0; }
    .usa-salvata:hover { background: #333; }
    .check-row { display: flex; align-items: center; gap: 10px; margin-bottom: 22px; font-size: 0.88em; color: #555; }
    .check-row input[type="checkbox"] { width: 17px; height: 17px; accent-color: #111; cursor: pointer; flex-shrink: 0; }
    .icone-carte { display: flex; gap: 8px; margin-bottom: 20px; }
    .icona-carta { background: #111; color: #fff; font-size: 0.7em; font-weight: bold; letter-spacing: 1px; padding: 5px 10px; border-radius: 4px; opacity: 0.6; }
    .btn-paga { display: block; width: 100%; background: #111; color: #fff; font-family: Georgia, serif; font-size: 1em; letter-spacing: 3px; text-transform: uppercase; padding: 16px; border: 2px solid #111; border-radius: 4px; cursor: pointer; transition: background 0.2s, color 0.2s; font-weight: bold; }
    .btn-paga:hover { background: #fff; color: #111; }
    .msg-errore { background: #fff0f0; border: 1px solid #e8b4b4; color: #c00; border-radius: 4px; padding: 12px 16px; margin-bottom: 20px; font-size: 0.9em; }
    .successo-box { max-width: 500px; margin: 80px auto; padding: 0 20px; text-align: center; }
    .check-icon { width: 72px; height: 72px; background: #111; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px; font-size: 2em; color: #fff; }
    .successo-box h2 { font-size: 2em; font-style: italic; margin-bottom: 14px; }
    .successo-box p  { color: #666; line-height: 1.7; margin-bottom: 30px; }
    .btn-home { display: inline-block; background: #111; color: #fff; font-family: Georgia, serif; font-size: 0.9em; letter-spacing: 2px; text-transform: uppercase; padding: 14px 32px; border: 2px solid #111; border-radius: 4px; cursor: pointer; text-decoration: none; transition: background 0.2s, color 0.2s; }
    .btn-home:hover { background: #fff; color: #111; }
    .sicuro-label { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.78em; color: #aaa; margin-top: 14px; letter-spacing: 1px; }
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
  <div class="page-grid">

    <!-- Riepilogo ordine -->
    <div class="card">
      <div class="card-title">Il tuo ordine</div>
      <ul class="riepilogo-lista">
        <?php foreach ($ordine as $v): ?>
          <li>
            <span>
              <span class="voce-nome"><?= htmlspecialchars($v['nome']) ?></span>
              <span class="voce-qty">×<?= (int)$v['qty'] ?></span>
            </span>
            <span>€ <?= number_format($v['prezzo'] * $v['qty'], 0) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="totale-row">
        <span>Totale</span>
        <span>€ <?= number_format($totale, 0) ?></span>
      </div>

      <?php if (!empty($note_ordine)): ?>
      <div class="note-riepilogo">
        <div class="note-riepilogo-label">📝 Note</div>
        <div class="note-riepilogo-testo"><?= htmlspecialchars($note_ordine) ?></div>
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