<?php include $_SERVER["DOCUMENT_ROOT"] . "/sidemenu.php";

function getProfilePicture($userData)
{
    return !empty($userData["profilePicture"])
        ? "data:image/;base64," . base64_encode($userData["profilePicture"])
        : "https://cdn-icons-png.flaticon.com/512/149/149071.png";
}

function updateUserProfile($mysqli, $userId, $name, $email, $tel, $cpf)
{
    $query = $mysqli->prepare("UPDATE users SET nome = ?, email = ?, tel = ?, cpf = ? WHERE id = ?");
    $query->bind_param("ssssi", $name, $email, $tel, $cpf, $userId);
    return $query->execute();
}

function removeProfilePicture($mysqli, $userId)
{
    $query = $mysqli->prepare("UPDATE users SET profilePicture = NULL WHERE id = ?");
    $query->bind_param("i", $userId);
    return $query->execute();
}

function updateProfilePicture($mysqli, $userId, $imageData)
{
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
$userDataMembroDesde = (new DateTime(datetime: $userData["created_at"]))->format('d/m/Y h:m:s');
$profilePicture = getProfilePicture($userData);
?>
<script src="./assets/js/main.js" defer></script>
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card radius-10">
            <div class="card-body">
                <form style="margin-left: 15px;" method="POST">
                    <h5 class="mb-3">Editar Perfil</h5>
                    <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">
                        <div class="user-change-photo shadow">
                            <img src="<?= $profilePicture ?>" alt="...">
                        </div>
                        <section style="color: white">
                            <form style="margin-left: 15px; width: 300px" method="POST">
                                <div>
                                    <div>
                                        <button type="button" id="imgProfileAlterar exampleModalLabel"
                                            class="btn btn-outline-primary btn-sm radius-30 px-4" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"><ion-icon
                                                name="person-sharp"></ion-icon>Alterar imagem</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title fs-5" id="exampleModalLabel">Alterar imagem
                                                        de perfil</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <input id="fileupload" type="file" name="newProfilePicture"
                                                        accept="image/png, image/jpeg, image/jpg" class="form-control"
                                                        required><br>
                                                    <p class="text-center">Enviar apenas arquivos com extensão JPG ou
                                                        PNG.</p>
                                                    <p class="text-center">Preferencia em imagens com proporção
                                                        quadrada.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="imgProfileDelete" type="button" class="btn btn-warning"
                                                        data-bs-dismiss="modal" id="btnCancelImg" style="margin-right: auto">Remover</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" id="btnCancelImg">Cancelar</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="btnSaveImg">Salvar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                </div>
                            </form>
                        </section>
                    </div>
                    <h5 class="mb-0 mt-4">Informações</h5>
                    <hr>
                    <div class="row g-3">
                        <div class="col-9">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control" value="<?= $userData['email'] ?>" maxlength="100"
                                required onkeypress="return validarEmail(event)">
                        </div>
                        <div class="col-3">
                            <label class="form-label">CPF</label>
                            <input id="cpfInput" type="text" class="form-control" value="<?= $userData['cpf'] ?>"
                                required onkeypress="return validarCpf(event)">
                        </div>
                        <div class="col-9">
                            <label class="form-label">Nome completo</label>
                            <input type="text" class="form-control" value="<?= $userData['nome'] ?>" required
                                onkeypress="return validarNome(event)">
                        </div>
                        <div class="col-3">
                            <label class="form-label">Telefone</label>
                            <input id="telefoneInput" type="text" class="form-control" value="<?= $userData['tel'] ?>"
                                required onkeypress="return validarTelefone(event)">
                        </div>
                    </div>
                    <h5 class="mb-0 mt-4">Endereço</h5>
                    <hr>
                    <div class="row g-3">
                        <div class="col-4">
                            <label class="form-label">CEP</label>
                            <input id="cepInput" type="text" class="form-control" value=""
                                onkeypress="return validarCep(event)">
                        </div>
                        <div class="col-2">
                            <label class="form-label">Número</label>
                            <input id="numberVal" maxlength="6" class="form-control" value=""
                                onkeypress="return validarNumero(event)">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Logradouro</label>
                            <input type="text" maxlength="150" class="form-control" value=""
                                onkeypress="return validarNome(event)">
                        </div>
                        <div class="col-5">
                            <label class="form-label">Cidade</label>
                            <input id="cidadeVal" maxlength="150" class="form-control" value=""
                                onkeypress="return validarNome(event)">
                        </div>
                        <div class="col-5">
                            <label class="form-label">País</label>
                            <input id="paisVal" maxlength="150" class="form-control" value=""
                                onkeypress="return validarNome(event)">
                        </div>
                        <div class="col-2">
                            <label class="form-label">Estado</label>
                            <select id="ufVal" class="form-control" required>
                                <option value="" hidden>Selecionar</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                    </div>
                    <h5 class="mb-0 mt-4">Empresa</h5>
                    <hr>
                    <div class="row g-3">
                        <div class="col-2">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" value="<?= $userData['companyId'] ?>" readonly>
                        </div>
                        <div class="col-10">
                            <label class="form-label">Nome da Empresa</label>
                            <input type="text" class="form-control" value="<?= $userData['companyId'] ?>" readonly>
                        </div>
                    </div>

                    <h5 class="mb-0 mt-4">Outros</h5>
                    <hr>
                    <div class="col-12">
                        <label class="form-label">Membro desde</label>
                        <input type="text" class="form-control" value="<?= $userDataMembroDesde ?>" readonly>
                    </div>
                    <div class="text-start mt-3">
                        <button type="button" class="btn btn-primary px-4">Salvar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<a href="javaScript:;" class="back-to-top"><ion-icon name="arrow-up-outline"></ion-icon></a>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
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

    function validarEmail(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[a-zA-Z0-9@._-]*$/;
        return regex.test(char);
    }

    function validarCpf(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[0-9]*$/;
        return regex.test(char);
    }

    function validarNome(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[a-zA-ZÀ-ÿ\s]*$/;
        return regex.test(char);
    }

    function validarTelefone(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[0-9]*$/;
        return regex.test(char);
    }

    function validarCep(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[0-9]*$/;
        return regex.test(char);
    }

    function validarNumero(event) {
        const char = String.fromCharCode(event.which);
        const regex = /^[0-9]*$/;
        return regex.test(char);
    }
</script>