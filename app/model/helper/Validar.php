<?php

class Validar {

  private string $email;
  private bool $resultado;

  function getResultado(): bool {
    return $this->resultado;
  }

  public function validaEmail($email){

    $this->email = $email;

    if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
      $this->resultado = true;
    } else {
      $this->resultado = false;
    }
  }
}