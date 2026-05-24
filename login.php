<?php
session_start();

$host     = "kodama.proxy.rlwy.net";
$port     = "54895";
$user     = "root";
$password = "MtOUjKrWVuKQkgLkHuClTXqRbUEfTaJf";
$db       = "prova5";

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$errore  = "";
$successo = "";

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome  = trim($_POST['nomeutente']);
        $passw = $_POST['password'];

        if ($_POST['azione'] === 'Accedi') {
            // ✅ Cerca solo per nome, poi verifica la password con password_verify()
            $sql  = "SELECT * FROM utente WHERE nome = :nome";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->execute();
            $utente = $stmt->fetch();

            if ($utente && password_verify($passw, $utente['password'])) {
                $_SESSION['nomeutente'] = $utente['nome'];
                header("Location: ordine.php");
                exit;
            } else {
                $errore = "Nome utente o password errati!";
            }

       } elseif ($_POST['azione'] === 'Registrati') {
    try {
        $passwordHash = password_hash($passw, PASSWORD_BCRYPT);

        $sql  = "INSERT INTO utente (nome, password) VALUES (:nome, :passw)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome',  $nome,         PDO::PARAM_STR);
        $stmt->bindParam(':passw', $passwordHash,  PDO::PARAM_STR);
        $stmt->execute();
        $successo = "Registrazione avvenuta correttamente!";

    } catch (PDOException $e) {
        // Errore 1062 = Duplicate entry (nome utente già esistente)
        if ($e->getCode() == 23000) {
            $errore = "QUESTO NOME UTENTE È GIÀ REGISTRATO! INSERISCI UN NOME UTENTE DIVERSO!";
        } else {
            // Mostra l'errore reale durante lo sviluppo
            $errore = "Errore durante la registrazione: " . $e->getMessage();
        }
    }
}
    }
} catch (PDOException $e) {
    $errore = "Errore di connessione: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi · Wallah Kebab</title>
    <link rel="icon" type="image/png" href="kebabbazzo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="grafica.css">

    <style>
        :root {
            --bg: #0f0d0b;
            --bg-soft: #161310;
            --card: #1c1815;
            --line: rgba(255, 255, 255, 0.08);
            --text: #f4ece1;
            --muted: #b9ad9c;
            --accent: #d4a056;
            --accent-strong: #e7b46a;
        }

        body.login-page {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(1200px 600px at 80% -10%, rgba(212, 160, 86, 0.18), transparent 60%),
                radial-gradient(900px 500px at -10% 110%, rgba(212, 160, 86, 0.10), transparent 60%),
                var(--bg);
            color: var(--text);
            font-family: 'Manrope', system-ui, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 100px 24px 60px;
            box-sizing: border-box;
        }

        .login-card {
            position: relative;
            width: 100%;
            max-width: 460px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0)), var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 56px 48px 44px;
            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 rgba(255, 255, 255, 0.04);
            text-align: left;
        }

        .login-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 18px;
            pointer-events: none;
            background: radial-gradient(600px 200px at 50% -20%, rgba(212, 160, 86, 0.18), transparent 70%);
            opacity: 0.9;
        }

        .login-card > * { position: relative; }

        .eyebrow {
            display: inline-block;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.72rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 18px;
        }

        .login-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-style: italic;
            font-weight: 700;
            font-size: clamp(2rem, 4vw, 2.6rem);
            line-height: 1.1;
            margin: 0 0 14px;
            color: var(--text);
        }

        .login-title .accent { color: var(--accent); }

        .login-sub {
            font-size: 0.98rem;
            color: var(--muted);
            margin: 0 0 34px;
            line-height: 1.55;
        }

        .scelta-stack {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 8px;
        }

        .cta-primary,
        .cta-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px 22px;
            border-radius: 999px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            border: 1px solid transparent;
            transition: transform 0.2s ease, background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
            text-decoration: none;
        }

        .cta-primary {
            background: var(--accent);
            color: #1a140c;
            box-shadow: 0 12px 30px rgba(212, 160, 86, 0.28);
        }
        .cta-primary:hover {
            background: var(--accent-strong);
            transform: translateY(-1px);
        }

        .cta-ghost {
            background: transparent;
            color: var(--text);
            border-color: rgba(255, 255, 255, 0.18);
        }
        .cta-ghost:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-1px);
        }

        #step-credenziali { display: none; }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: 0.78rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .field input[type="text"],
        .field input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            background: var(--bg-soft);
            border: 1px solid var(--line);
            border-radius: 12px;
            color: var(--text);
            font-family: 'Manrope', sans-serif;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field input:focus {
            outline: none;
            border-color: var(--accent);
            background: #1f1a15;
            box-shadow: 0 0 0 4px rgba(212, 160, 86, 0.15);
        }

        .field input::placeholder { color: #6b6258; }

        .submit-row { margin-top: 26px; }

        .btn-indietro {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            background: transparent;
            border: none;
            color: var(--muted);
            font-family: 'Manrope', sans-serif;
            font-size: 0.88rem;
            letter-spacing: 0.05em;
            cursor: pointer;
            padding: 6px 0;
            transition: color 0.2s ease, transform 0.2s ease;
        }
        .btn-indietro:hover {
            color: var(--accent);
            transform: translateX(-2px);
        }

        .etichetta-azione {
            font-family: 'Playfair Display', Georgia, serif;
            font-style: italic;
            font-size: 1rem;
            color: var(--muted);
            margin: 0 0 26px;
        }

        .messaggio {
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 22px;
            font-size: 0.92rem;
            line-height: 1.45;
            border: 1px solid transparent;
        }
        .messaggio-errore {
            background: rgba(255, 107, 107, 0.08);
            border-color: rgba(255, 107, 107, 0.35);
            color: #ffb3b3;
        }
        .messaggio-successo {
            background: rgba(123, 211, 137, 0.08);
            border-color: rgba(123, 211, 137, 0.35);
            color: #b8eac1;
        }

        .imageHome {
            position: fixed;
            top: 22px;
            left: 22px;
            z-index: 10;
        }

        @media (max-width: 520px) {
            .login-card { padding: 44px 26px 32px; border-radius: 14px; }
            body.login-page { padding: 90px 16px 40px; }
        }
    </style>
</head>

<body class="login-page">

    <button class="imageHome" onclick="window.location.href='index.php'" aria-label="Home"></button>

    <form method="POST" action="" class="login-card" autocomplete="off">

        <?php if ($errore): ?>
            <p class="messaggio messaggio-errore"><?= htmlspecialchars($errore) ?></p>
        <?php endif; ?>
        <?php if ($successo): ?>
            <p class="messaggio messaggio-successo"><?= htmlspecialchars($successo) ?></p>
        <?php endif; ?>

        <div id="step-scelta">
            <span class="eyebrow">Area riservata</span>
            <h1 class="login-title">Accedi o <span class="accent">registrati</span></h1>
            <p class="login-sub">Entra nel tuo account per ordinare il tuo kebab preferito, oppure crea un nuovo profilo in pochi secondi.</p>

            <div class="scelta-stack">
                <button type="button" class="cta-primary" onclick="scegli('Accedi')">Accedi</button>
                <button type="button" class="cta-ghost"  onclick="scegli('Registrati')">Registrati</button>
            </div>
        </div>

        <div id="step-credenziali">
            <span class="eyebrow">Wallah Kebab</span>
            <h1 class="login-title" id="titolo-step2"><span class="accent">Accedi</span></h1>
            <p class="etichetta-azione" id="etichetta-azione"></p>

            <div class="field">
                <label for="nomeutente">Nome utente</label>
                <input type="text" id="nomeutente" name="nomeutente" placeholder="Es. mario.rossi">
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••">
            </div>

            <input type="hidden" id="azione-hidden" name="azione" value="">

            <div class="submit-row">
                <input type="submit" class="cta-primary" value="Conferma">
            </div>

            <button type="button" class="btn-indietro" onclick="torna()">← Torna indietro</button>
        </div>

    </form>

    <script>
        <?php if ($errore || $successo): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var azione = "<?= htmlspecialchars($_POST['azione'] ?? '') ?>";
                if (azione) scegli(azione);
            });
        <?php endif; ?>

        function scegli(azione) {
            document.getElementById('step-scelta').style.display = 'none';
            document.getElementById('step-credenziali').style.display = 'block';
            document.getElementById('azione-hidden').value = azione;

            var titolo = document.getElementById('titolo-step2');
            titolo.innerHTML = '<span class="accent">' + azione + '</span>';

            document.getElementById('etichetta-azione').textContent =
                azione === 'Accedi'
                    ? 'Inserisci le tue credenziali per accedere.'
                    : 'Scegli un nome utente e una password per registrarti.';
        }

        function torna() {
            document.getElementById('step-credenziali').style.display = 'none';
            document.getElementById('step-scelta').style.display = 'block';
        }
    </script>
</body>
</html>