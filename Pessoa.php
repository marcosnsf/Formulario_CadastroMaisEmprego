<?php
    class Pessoa {


        var $Id;
        var $Nome;
        var $Email;
        Var $Fixo;
        Var $Tel;
        Var $Cpf;
        Var $Cep;
        var $Logradouro;
        var $Bairro;
        var $Cidade;
        var $Numero;
        var $Complemento;
        var $Estado;
        var $Funcao;
        var $Outros;


        function __construct($Nome, $Email, $Fixo, $Tel, $Cpf, $Cep, $Logradouro, $Bairro, $Cidade, $Numero, $Complemento, $Estado, $Funcao, $Outros)
        {
            $this->Id = guidv4();
            $this->Nome = $Nome;
            $this->Email = $Email;
            $this->Fixo = $Fixo;
            $this->Tel = $Tel;
            $this->Cpf = $Cpf;
            $this->Cep = $Cep;
            $this->Logradouro = $Logradouro;
            $this->Bairro = $Bairro;
            $this->Cidade = $Cidade;
            $this->Numero = $Numero;
            $this->Complemento = $Complemento;
            $this->Estado = $Estado;
            $this->Funcao = $Funcao;
            $this->Outros = $Outros;
           
        }

    }
?>