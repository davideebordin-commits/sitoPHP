    <?php
    session_start();

    header('Content-Type: application/json');

    if (!isset($_SESSION['nomeutente'])) {
        echo json_encode(['ok' => false, 'errore' => 'Non autenticato']);
        exit;
    }

    $raw  = file_get_contents('php://input');
    $body = json_decode($raw, true);

    // Supporta sia il nuovo formato {voci, note} che il vecchio array diretto
    if (isset($body['voci'])) {
        $dati = $body['voci'];
        $note = trim($body['note'] ?? '');
    } else {
        $dati = $body;
        $note = '';
    }

    if (!$dati || !is_array($dati) || count($dati) === 0) {
        echo json_encode(['ok' => false, 'errore' => 'Ordine vuoto']);
        exit;
    }

    $totale      = 0;
    $descrizione = [];

    foreach ($dati as $voce) {
        $totale        += $voce['prezzo'] * $voce['qty'];
        $descrizione[]  = $voce['qty'] . 'x ' . $voce['nome'];
    }

    $_SESSION['ordine']      = $dati;
    $_SESSION['totale']      = $totale;
    $_SESSION['descrizione'] = implode(', ', $descrizione);
    $_SESSION['note_ordine'] = $note;

    echo json_encode(['ok' => true]);