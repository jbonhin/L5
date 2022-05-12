<?php
include_once "./app/connection/Connection.php";
include_once "./app/dao/UserDAO.php";
include_once "./app/model/User.php";

//instancia as classes
$user = new User();
$userDAO = new UserDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="icon" href="app/assets/image/favicon.ico" />

  <title>L5-CRUD PHP-OO</title>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  <style>
      .menu,
      thead {
          background-color: #bbb !important;
      }

      .row {
          padding: 10px;
      }
  </style>
</head>

<body>
  <nav class="navbar navbar-light bg-light menu">
    <div class="container">
      <a class="navbar-brand" href="https://www.l5.com.br/" target="_blank" >
      <h4>
        <img src="app/assets/image/logo-black.png" width=60 />
          Teste-CRUD
      </h4>
      </a>
    </div>
  </nav>
  <div class="container">
    <form id="valida_cadastrar" action="app/controller/UserController.php" method="POST">
      <div class="row">
        <div class="col-md-3">
          <label>Nome</label>
          <input id="nome" type="text" name="nome" value="" autofocus class="form-control" />
        </div>
        <div class="col-md-5">
          <label>E-mail</label>
          <input id="email" type="text" name="email" value="" class="form-control" />
        </div>
        <div class="col-md-2">
          <label>Telefone</label>
          <input id="telefone" type="text" name="telefone" value="" class="form-control phone"/>
        </div>
        <div class="col-md-2">
          <label>CPF</label>
          <input id="cpf" type="text" name="cpf" value="" class="form-control cpf" />
        </div>
        <div class="col-md-2">
          <br>
          <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
        </div>
      </div>
    </form>
    
    <span class="msg"></span>
    
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <hr>
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($userDAO->read() as $user) : ?>
            <tr>
              <td><?= $user->getId() ?></td>
              <td><?= $user->getNome() ?></td>
              <td><?= $user->getEmail() ?></td>
              <td class="phone"><?= $user->getTelefone() ?></td>
              <td class="cpf"><?= $user->getCpf()?></td>
              <td class="text-center">
                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $user->getId() ?>">
                    Editar
                </button>
                <a href="app/controller/UserController.php?del=<?= $user->getId() ?>" data-confirm="Excluir">
                <button class="btn  btn-danger btn-sm" type="button" >Excluir</button>
                </a>
              </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editar><?= $user->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="valida_editar" action="app/controller/UserController.php" method="POST">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Nome</label>
                        <input id="nomeModal" type="text" name="nome" value="<?= $user->getNome() ?>" class="form-control" require />
                      </div>
                      <div class="col-md-7">
                        <label>E-mail</label>
                        <input id="emailModal" type="text" name="email" value="<?= $user->getEmail() ?>" class="form-control" require />
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label>Telefone</label>
                          <input 
                            id="foneModal" 
                            type="text" 
                            name="telefone" 
                            value="<?= $user->getTelefone() ?>" 
                            class="form-control phone" 
                            require
                          />
                        </div>
                        <div class="col-md-3">
                          <label>CPF</label>
                          <input 
                            id="cpfModal" 
                            type="text" 
                            name="cpf" 
                            value="<?= $user->getCpf() ?>" 
                            class="form-control cpf" 
                            require 
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="msg-error"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <input type="hidden" name="id" value="<?= $user->getId() ?>" />
                          <button class="btn btn-primary" type="submit" name="editar">Atualizar</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
      $(document).ready(function(){
          $('.phone').mask('(00) 0000-0000');
          $('.cpf').mask('000.000.000-00');
      });
  </script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./app/assets/js/users.js"></script>
</body>

</html>