<?php
include_once "../connection/Connection.php";
include_once "../model/User.php";
include_once "../dao/UserDAO.php";

//instancia as classes
$user = new User();
$userdao = new UserDAO();

//pega todos os dados passado por POST

$data = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $user->setNome($data['nome']);
    $user->setEmail($data['email']);
    $user->setTelefone($data['telefone']);
    $user->setCpf($data['cpf']);

    $userdao->create($user);

    header("Location: ../../");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $user->setNome($data['nome']);
    $user->setEmail($data['email']);
    $user->setTelefone($data['telefone']);
    $user->setCpf($data['cpf']);
    $user->setId($data['id']);

    $userdao->update($user);

    header("Location: ../../");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $user->setId($_GET['del']);

    $userdao->delete($user);

    header("Location: ../../");
}else{
    header("Location: ../../");
}