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
        $nome  = $_POST['nomeutente'];
        $passw = $_POST['password'];

        if ($_POST['azione'] === 'Accedi') {
            $sql  = "SELECT * FROM utente WHERE nome = :nome AND password = :passw";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome',  $nome,  PDO::PARAM_STR);
            $stmt->bindParam(':passw', $passw, PDO::PARAM_STR);
            $stmt->execute();
            $utente = $stmt->fetch();

            if ($utente) {
                $_SESSION['nomeutente'] = $utente['nome'];
                header("Location: ordine.php");
                exit;
            } else {
                $errore = "Nome utente o password errati!";
            }
        } elseif ($_POST['azione'] === 'Registrati') {
            try {
                $sql  = "INSERT INTO utente (nome, password) VALUES (:nome, :passw)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nome',  $nome,  PDO::PARAM_STR);
                $stmt->bindParam(':passw', $passw, PDO::PARAM_STR);
                $stmt->execute();
                $successo = "Registrazione avvenuta correttamente!";
            } catch (PDOException $e) {
                $errore = "QUESTO NOME UTENTE È GIÀ REGISTRATO! INSERISCI UN NOME UTENTE DIVERSO!";
            }
        }
    }
} catch (PDOException $e) {
    $errore = "Errore di connessione: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="grafica.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <button class="imageHome" onclick="window.location.href='index.php'"></button>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            padding: 40px 50px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 10px;
            text-align: center;
            min-width: 320px;
        }

        .titoletto {
            position: static;
            font-size: 1.3em;
            margin-bottom: 30px;
        }

        .scelta-btn {
            display: block;
            width: 100%;
            margin: 12px 0;
            background-color: #111;
            color: #fff;
            font-family: Georgia, serif;
            font-size: 1.1em;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 16px 0;
            border: 2px solid #111;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .scelta-btn:hover {
            background-color: #fff;
            color: #111;
        }

        #step-credenziali {
            display: none;
        }

        #step-credenziali label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-family: Georgia, serif;
        }

        #step-credenziali input[type="text"],
        #step-credenziali input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .btn-indietro {
            background: transparent;
            border: none;
            color: #666;
            font-size: 0.9em;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: underline;
            padding: 0;
            width: auto;
            height: auto;
            border-radius: 0;
        }

        .btn-indietro:hover {
            color: #111;
        }

        #etichetta-azione {
            font-family: Georgia, serif;
            font-size: 0.95em;
            color: #555;
            margin-bottom: 20px;
            font-style: italic;
        }

        .messaggio-errore {
            color: red;
            font-family: Georgia, serif;
            text-align: center;
            margin-bottom: 15px;
        }

        .messaggio-successo {
            color: green;
            font-family: Georgia, serif;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <form method="POST" action="">

        <?php if ($errore): ?>
            <p class="messaggio-errore"><?= htmlspecialchars($errore) ?></p>
        <?php endif; ?>
        <?php if ($successo): ?>
            <p class="messaggio-successo"><?= htmlspecialchars($successo) ?></p>
        <?php endif; ?>

        <div id="step-scelta">
            <h6 class="titoletto">Accedi o Registrati per ordinare</h6>
            <button type="button" class="scelta-btn" onclick="scegli('Accedi')">Accedi</button>
            <button type="button" class="scelta-btn" onclick="scegli('Registrati')">Registrati</button>
        </div>

        <div id="step-credenziali">
            <h3 class="titoletto" id="titolo-step2">Accedi</h3>
            <p id="etichetta-azione"></p>

            <label for="nomeutente">Nome Utente:</label>
            <input type="text" id="nomeutente" name="nomeutente">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <input type="hidden" id="azione-hidden" name="azione" value="">

            <input type="submit" class="scelta-btn" value="INVIO">
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
            document.getElementById('titolo-step2').textContent = azione;
            document.getElementById('etichetta-azione').textContent =
                azione === 'Accedi' ?
                'Inserisci le tue credenziali per accedere.' :
                'Scegli un nome utente e una password per registrarti.';
        }

        function torna() {
            document.getElementById('step-credenziali').style.display = 'none';
            document.getElementById('step-scelta').style.display = 'block';
        }
    </script>
</body>
</html>