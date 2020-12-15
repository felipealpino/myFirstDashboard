<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/package/dist/sweetalert2.min.css">
    <title>Cadastre-se</title>
</head>
<body>
    <div class="form-width-cadastro">
        <form method="POST" action="" class="form-cadastrar-login" id="form-cadastrar-login">
            
            <div class="form-group">
                <label for="email-input-cadastrar">Nome Completo</label>
                <input type="text" name="formCadastrarNome" class="form-control" id="nome-form-cadastrar" placeholder="Digite um nome">
            </div>
            
            <div class="form-group">
                <label for="email-input-cadastrar">Email</label>
                <input type="email" name="formCadastrarEmail" class="form-control" id="emailf-form-cadastrar" placeholder="Digite um email válido">
            </div>
            
            <div class="form-group">
                <label for="email-input-cadastrar">Cpf</label>
                <input type="text" name="formCadastrarCpf" class="form-control" id="Cpf-form-cadastrar" maxlength="11" placeholder="Digite um CPF válido (somente números)" >
            </div>

            <div class="form-group ">
                <label for="aniversario-dia-input-cadastrar">Aniversário</label>
                <div class="form-group aniversario">
                    <select name="formCadastrarAniversarioDia" id="aniversario-dia-form-cadastrar">
                        <option value="0">Dia</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select name="formCadastrarAniversarioMes" id="aniversario-mes-form-cadastrar">
                        <option value="0">Mês</option>
                        <option value="janeiro">Janeiro</option>
                        <option value="fevereiro">Fevereiro</option>
                        <option value="marco">Março</option>
                        <option value="abril">Abril</option>
                        <option value="maio">Maio</option>
                        <option value="junho">Junho</option>
                        <option value="julho">Julho</option>
                        <option value="agosto">Agosto</option>
                        <option value="setembro">Setembro</option>
                        <option value="outubro">Outubro</option>
                        <option value="novembro">Novembro</option>
                        <option value="dezembro">Dezembro</option>
                    </select>
                    <input type="number" class="formCadastrarAno" value="ano" name="formCadastrarAniversarioAno" id="aniversario-ano-form-cadastrar">
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="formCadastrarGenero" id="Genero-Masc-form-cadastrar" value="Masculino" checked>
                    <label class="form-check-label">
                      Masculino
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="formCadastrarGenero" id="Genero-Fem-form-cadastrar" value="Feminino">
                    <label class="form-check-label" for="exampleRadios2">
                      Feminino
                    </label>
                  </div>            
            </div>

            <div class="senha-input-cadastrar">
                <input type="file" name="formCadastrarFile" class="formCadastrarFileInput" id="file-form-cadastrar">
            </div> 

            <div class="senha-input-cadastrar">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" name="formCadastrarSenha" class="form-control" id="senha-form-cadastrar" placeholder="Digite sua senha">
            </div>

            <div class="confirmar-senha-input-cadastrar">
                <label for="exampleInputPassword1">Confirmar enha</label>
                <input type="password" name="formCadastrarConfirmarSenha" class="form-control" id="confirmar-senha-form-cadastrar" placeholder="Digine novamente a senha">
            </div>
            
            <button type="submit" class="btn btn-submit-forms btn-submit-cadastrar">Cadastrar</button>

        </form>
    </div>

    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="plugins/package/dist/sweetalert2.all.min.js"></script>
    <script src="js/validate/validate-cadastrar.js"></script>
    <script src="plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>