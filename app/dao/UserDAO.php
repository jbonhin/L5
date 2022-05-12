<?php

class UserDAO {

  public function create(User $user){
    try {
      $query = "INSERT INTO 
        users (nome, email, telefone, cpf) 
      VALUES 
        (:nome, :email, :telefone, :cpf)";
      
      $paramSql = Connection::getConnection()->prepare($query);
      $paramSql->bindValue(":nome", $user->getNome());
      $paramSql->bindValue(":email", $user->getEmail());
      $paramSql->bindValue(":telefone", $user->getTelefone());
      $paramSql->bindValue(":cpf", $user->getCpf());

      return $paramSql->execute();
      
    } catch (Exception $e) {
      print "Erro ao Inserir usuário <br>" . $e . '<br>';
    }
  }

  public function read() {
    try {
      $query = "SELECT * FROM users order by nome asc";
      $result = Connection::getConnection()->query($query);
      $lista = $result->fetchAll(PDO::FETCH_ASSOC);
      $fetchLista = array();
      foreach ($lista as $l) {
          $fetchLista[] = $this->listUsers($l);
      }
      return $fetchLista;

    } catch (Exception $e) {
        print "Ocorreu um erro ao tentar Buscar Todos." . $e;
    }
  }
     
  public function update(User $user) {
      try {
          $query = "UPDATE users set
              nome = :nome,
              email = :email,
              telefone = :telefone,
              cpf = :cpf                                            
            WHERE id = :id";

          $paramSql = Connection::getConnection()->prepare($query);
          $paramSql->bindValue(":id", $user->getId());
          $paramSql->bindValue(":nome", $user->getNome());
          $paramSql->bindValue(":email", $user->getEmail());
          $paramSql->bindValue(":telefone", $user->getTelefone());
          $paramSql->bindValue(":cpf", $user->getCpf());
          return $paramSql->execute();
      } catch (Exception $e) {
          print "Ocorreu um erro na tentativa de alterar os dados do usuário!<br> $e <br>";
      }
  }

  public function delete(User $user) {
      try {
          $query = "DELETE FROM users WHERE id = :id";
          $paramSql = Connection::getConnection()->prepare($query);
          $paramSql->bindValue(":id", $user->getId());
          return $paramSql->execute();
      } catch (Exception $e) {
          echo "Erro na tentativa de excluir usuário!<br> $e <br>";
      }
  }

  private function listUsers($row){
    $user = new User();
    $user->setId($row['id']);
    $user->setNome($row['nome']);
    $user->setEmail($row['email']);
    $user->setTelefone($row['telefone']);
    $user->setCpf($row['cpf']);

    return $user;
  }
}