<?php
include $_SERVER["DOCUMENT_ROOT"] . "/sidemenu.php";

$query = $mysqli->query("SELECT * FROM users WHERE id = '$_SESSION[id]'");
$userData = $query->fetch_assoc();

if($userData["profilePicture"] != NULL){
    $profilePicture = "data:image/png;base64," . base64_encode($userData["profilePicture"]);
} else {
    $profilePicture = "https://cdn-icons-png.flaticon.com/512/149/149071.png";
}

$query = $mysqli->query('SELECT * FROM users WHERE id = ' . $_SESSION["id"]);
$userData = $query->fetch_assoc();

?>

<head>
    <title>Alterar Senha</title>
</head>
<body>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form method="POST">
            <p>
                <input id="email" name="email" type="password" required>
                <label for="email">Senha atual</label>
            </p>
            <p>
                <input id="novaSenha" name="novaSenha" type="password" required>
                <label for="novaSenha">Nova senha</label>
            </p>
            <p>
                <input id="confirmaSenha" name="confirmaSenha" type="password" required>
                <label for="confirmaSenha">Confirmar senha</label>
            </p>
            <button type="submit">Alterar</button>
        </form>
    </div>
</body>
</html>

<?php 

if(isset($_POST['confirmaSenha']) && isset($_POST['novaSenha']) && isset($_POST['email'])){

    $novaSenha = $_POST['novaSenha'];
    $confirmaSenha = $_POST['confirmaSenha'];
    $email = $_POST['email'];

    if($novaSenha === $confirmaSenha){

        $sql_query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $sql_query->bind_param("i", $_SESSION['id']);
        $sql_query->execute();
        $result = $sql_query->get_result();
        $passChange = $result->fetch_assoc();

        if(isset($passChange['password'])){

            $passVerify = $passChange['password'];

            if(password_verify($email, $passVerify)){
                $aplicarSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
                $sql_query = $mysqli->prepare("UPDATE users SET password = ? WHERE id = ?");
                $sql_query->bind_param("si", $aplicarSenha, $_SESSION['id']);
                $sql_query->execute();

                $sql_log = "INSERT INTO mainlog (function, userId, userName, userEmail, adress) 
                VALUES ('alterouSenha', ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($sql_log);
                $stmt->bind_param("issi", $passChange['id'], $passChange['nome'], $passChange['email'], $_SERVER['REMOTE_ADDR']);
                $stmt->execute();
            }
        }
    }
}

?>
