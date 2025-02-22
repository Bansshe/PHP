<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/sidemenu.php";

function getProfilePicture($userData) {
    return !empty($userData["profilePicture"]) 
        ? "data:image/;base64," . base64_encode($userData["profilePicture"])
        : "https://cdn-icons-png.flaticon.com/512/149/149071.png";
}

function updateUserProfile($mysqli, $userId, $name, $email, $tel, $cpf) {
    $query = $mysqli->prepare("UPDATE users SET nome = ?, email = ?, tel = ?, cpf = ? WHERE id = ?");
    $query->bind_param("ssssi", $name, $email, $tel, $cpf, $userId);
    return $query->execute();
}

function removeProfilePicture($mysqli, $userId) {
    $query = $mysqli->prepare("UPDATE users SET profilePicture = NULL WHERE id = ?");
    $query->bind_param("i", $userId);
    return $query->execute();
}

function updateProfilePicture($mysqli, $userId, $imageData) {
    $query = $mysqli->prepare("UPDATE users SET profilePicture = ? WHERE id = ?");
    $query->bind_param("si", $imageData, $userId);
    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateUserProfileName'])) {
        updateUserProfile($mysqli, $_SESSION['id'], $_POST['updateUserProfileName'], $_POST['updateUserProfileEmail'], $_POST['updateUserProfileTel'], $_POST['updateUserProfileCpf']);
    } elseif (isset($_POST['commandExecute']) && $_POST['commandExecute'] === 'removeProfilePicture') {
        removeProfilePicture($mysqli, $_SESSION['id']);
    } elseif (isset($_FILES['newProfilePicture'])) {
        $image = $_FILES['newProfilePicture'];
        if ($image['error'] === UPLOAD_ERR_OK && exif_imagetype($image['tmp_name']) && in_array($image['type'], ['image/jpeg', 'image/png'])) {
            $imageData = addslashes(file_get_contents($image['tmp_name']));
            updateProfilePicture($mysqli, $_SESSION['id'], $imageData);
        }
    }
}

$query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $_SESSION['id']);
$query->execute();
$result = $query->get_result();
$userData = $result->fetch_assoc();
$profilePicture = getProfilePicture($userData);
?>

<html lang="pt-br">
<style>
    #profilePictureForm, #userDetailsForm {
    margin-left: 15px;
    width: 300px;
}

.profile-picture p, .user-details p {
    margin-bottom: 10px;
}

#profilePicture {
    width: 150px;
    height: 150px;
}

.modal-body p {
    margin-top: 20px;
    font-size: 12px;
}
</style>
<body style="margin-left: 260px">
    <section style="color: white">
        <form style="margin-left: 15px; width: 300px" method="POST">
            <div>
                <label for="profilePicture">Foto de perfil</label>
                <img id="profilePicture" style="width: 150px; height: 150px" src="<?=$profilePicture?>">
                <div>
                    <button id="imgProfileAlterar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Alterar</button>
                    <button id="imgProfileDelete" type="button" class="btn btn-danger">Remover</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="exampleModalLabel">Alterar imagem de perfil</h2>
                            </div>
                            <div class="modal-body">
                                <input id="fileupload" type="file" name="newProfilePicture" accept="image/png, image/jpeg, image/jpg" class="form-control" required>
                                <p class="text-center">Enviar apenas arquivos com extensão JPG ou PNG.</p>
                                <p class="text-center">Preferencia em imagens com proporção quadrada.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelImg">Cancelar</button>
                                <button type="submit" class="btn btn-success"  id="btnSaveImg">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
        </form>
        <form style="margin-left: 15px; width: 300px" method="POST">
            <div>
                <label for="nameEditavel">Nome completo</label> 
                <input id="nameEditavel" class="inputEditavel form-control" name="updateUserProfileName" value="<?=$userData['nome']?>" readonly required>
            </div>
            <div>
                <label for="mailEditavel">Email</label>
                <input id="mailEditavel" class="inputEditavel form-control" name="updateUserProfileEmail" value="<?=$userData['email']?>" readonly required>
            </div>
            <div>
                <label for="telEditavel">Telefone</label>
                <input id="telEditavel" class="inputEditavel form-control" name="updateUserProfileTel" value="<?=$userData['tel']?>" readonly>
            </div>
            <div>
                <label for="cpfEditavel">CPF</label>
                <input id="cpfEditavel" class="inputEditavel form-control" name="updateUserProfileCpf" value="<?=$userData['cpf']?>" readonly>
            </div>
            <div>
                <label for="companyId">Empresa</label>
                <input id="companyId" class="form-control" value="<?=$userData['companyId']?>" readonly>
            </div>
            <div>
                <label for="created_at">Membro desde</label>
                <input id="created_at" class="form-control" value="<?=$userData['created_at']?>" readonly required>
            </div>
            <input id="btnSalvarPerfil" class="btn btn-success" type="submit" value="Salvar" onclick="btnSalvarPerfil()" hidden disabled>
        </form>
        <button id="btnEditarPerfil" class="btn btn-danger" type="button" onclick="toggleEditPerfil()">Editar</button>
    </section>
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/feather-icons/feather.min.js"></script>
        <script src="/assets/vendors/chartjs/Chart.min.js"></script>
        <script src="/assets/vendors/apexcharts/apexcharts.min.js"></script>
        </div>
    </div>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnEditarPerfil").addEventListener("click", toggleEditPerfil);
        document.getElementById("btnSaveImg").addEventListener("click", salvarPerfil);

        document.getElementById("imgProfileDelete").addEventListener("click", function() {
            var deleteImgVal = confirm("Tem certeza que quer remover sua foto?");
            if (deleteImgVal) {
                this.disabled = true;
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "configuracoes.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send(encodeURI('commandExecute=removeProfilePicture'));
            }
        });
    });

    function btnSalvarPerfil() {
    var idsToDisable = ["btnSalvarPerfil", "imgProfileAlterar"];
    var idsToHide = ["btnSalvarPerfil", "imgProfileAlterar"];
    var idsToReadOnly = ["mailEditavel", "nameEditavel", "telEditavel", "cpfEditavel"];
    var idsToEnable = ["btnEditarPerfil"];
    var idsToShow = ["btnEditarPerfil"];

    idsToDisable.forEach(id => document.getElementById(id).disabled = true);
    idsToHide.forEach(id => document.getElementById(id).hidden = true);
    idsToReadOnly.forEach(id => document.getElementById(id).readOnly = true);
    idsToEnable.forEach(id => document.getElementById(id).disabled = false);
    idsToShow.forEach(id => document.getElementById(id).hidden = false);
    }


    function toggleEditPerfil() {
        var inputs = document.getElementsByClassName("inputEditavel");
        var imgProfileAlterar = document.getElementById("imgProfileAlterar");
        var btnSavePerfil = document.getElementById("btnSalvarPerfil");

        Array.from(inputs).forEach(input => input.readOnly = !input.readOnly);

        imgProfileAlterar.disabled = !imgProfileAlterar.disabled;
        btnSavePerfil.hidden = !btnSavePerfil.hidden;
    }

</script>