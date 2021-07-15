<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    
    include "uuid.php";
    include 'Pessoa.php';
    include 'Resposta.php'; 
    use PDOException;
    use Exception;

    
    try{

        $_POST = json_decode(file_get_contents('php://input'), true);

        $ok = Salvar();

        if($ok == true){
            
            echo true;
         }
         else
         {
             echo false;
         }
     }
     catch(Exception $e)
     {
         header('Content-Type: application/json; charset=UTF-8');
         header('HTTP/1.1 500 Internal Server error {'.$e->getMessage().'}');
         echo "error : ".$e->getMessage();
         return false;
     }
   
    function InserirPessoa()
    {
        $pessoa = new Pessoa(

            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Nome"]),
            preg_replace('/[^a-zA-Z0-9\/:@\.\+-s]/','',$_POST["Email"]),
            preg_replace('/[^0-9-()]/','',$_POST["Fixo"]),
            preg_replace('/[^0-9.-]/', '',$_POST["Tel"]),
            preg_replace('/[^0-9.-]/', '',$_POST["Cpf"]),
            preg_replace('/[^0-9.-]/', '',$_POST["Cep"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Logradouro"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Bairro"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Cidade"]),
            preg_replace('/[^0-9-()]/','',$_POST["Numero"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/','',$_POST["Complemento"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Estado"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/','',$_POST["Funcao"]),
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/','',$_POST["Outros"])
        );
        $Id = str_replace("-","",$pessoa->Id);
    
        if(VerificaPessoa($pessoa) == false)
        {
            $username = "natan";
            $password = "pre1958@@";
            
            /* echo $pessoa->Endereco . "\n";
            echo $pessoa->Bairro. "\n";
            echo $pessoa->CPF. "\n";
            echo $pessoa->Email. "\n";
            echo $pessoa->Telefone. "\n";
            echo $pessoa->Rg. "\n";
            echo $pessoa->DataNascimento. "\n";
            echo $pessoa->Nascido; */
            try
            {
                 $con = new PDO("mysql:host=10.0.40.38;dbname=cadastro_pat", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                 $stmt= $con->prepare("INSERT INTO pessoa(Id, Nome, Email, Fixo, Tel, Cpf, Cep, Logradouro, Bairro, Cidade, Numero, Complemento, Estado, Funcao, Outros) 
                 
                 VALUES (UNHEX(:Id), :Nome, :Email, :Fixo, :Tel, :Cpf, :Cep, :Logradouro, :Bairro, :Cidade, :Numero, :Complemento, :Estado, :Funcao, :Outros)");
                    
                 $con->setAttribute(PDO::ATTR_ERRMODE, $con::ERRMODE_EXCEPTION);

                 $stmt->bindValue(':Id',$Id, PDO::PARAM_STR);
                 $stmt->bindValue(':Nome', $pessoa->Nome, PDO::PARAM_STR);
                 $stmt->bindValue(':Email', $pessoa->Email,PDO::PARAM_STR);
                 $stmt->bindValue(':Fixo', $pessoa->Fixo , PDO::PARAM_STR);
                 $stmt->bindValue(':Tel', $pessoa->Tel, PDO::PARAM_STR);
                 $stmt->bindValue(':Cpf', $pessoa->Cpf , PDO::PARAM_STR);
                 $stmt->bindValue(':Cep', $pessoa->Cep, PDO::PARAM_STR);
                 $stmt->bindValue(':Logradouro', $pessoa->Logradouro,PDO::PARAM_STR);
                 $stmt->bindValue(':Bairro', $pessoa->Bairro, PDO::PARAM_STR);
                 $stmt->bindValue(':Cidade', $pessoa->Cidade, PDO::PARAM_STR);
                 $stmt->bindValue(':Numero', $pessoa->Numero, PDO::PARAM_STR); 
                 $stmt->bindValue(':Complemento', $pessoa->Complemento ,PDO::PARAM_STR);    
                 $stmt->bindValue(':Estado', $pessoa->Estado , PDO::PARAM_STR); 
                 $stmt->bindValue(':Funcao', $pessoa->Funcao, PDO::PARAM_STR);
                 $stmt->bindValue(':Outros', $pessoa->Outros, PDO::PARAM_STR);
                 $stmt->execute();
                
                 /*   $stmt->bindValue(':CPF', $pessoa->CPF,PDO::PARAM_STR);
                 $stmt->bindValue(':Email', $pessoa->Email,PDO::PARAM_STR); */
                      /*  $stmt->bindValue(':RG', $pessoa->Rg,PDO::PARAM_STR); */
                // echo "\n linhas:" . $stmt->rowCount();
                 
            }
            catch(PDOException $e){
                header('Content-Type: application/json; charset=UTF-8');
                header('HTTP/1.1 500 Internal Server error{'.$e->getMessage().'}');
                echo "Execute Failed:  ". $e->getMessage();
                die(false);
            }
            
            return $Id;
        }
        return null;
    }

    function InserirResposta($IdPessoa)
    {
        $resposta = new Resposta(
            $IdPessoa,
            //
            " Faça um breve resumo sobre você",
            preg_replace('/[^a-zA-Z1-9\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ-]/', '',$_POST["Resumo"])
            //
           
        );
        
        $Id = str_replace("-","",$resposta->Id);

        //echo $resposta->PrimeiraPergunta . "\n";

        try{
            $username = "natan";
            $password = "pre1958@@";
            
            $con = new PDO("mysql:host=10.0.40.38;dbname=cadastro_pat", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $stmt= $con->prepare("INSERT INTO resposta(Id, IdPessoa, PrimeiraPergunta, PrimeiraResposta) 
            VALUES (UNHEX(:Id), UNHEX(:IdPessoa), :PrimeiraPergunta, :PrimeiraResposta)");
            
            $con->setAttribute(PDO::ATTR_ERRMODE, $con::ERRMODE_EXCEPTION);
            $stmt->bindValue(':Id', $Id, PDO::PARAM_STR);
            $stmt->bindValue(':IdPessoa', $IdPessoa, PDO::PARAM_STR);
            $stmt->bindValue(':PrimeiraPergunta', $resposta->PrimeiraPergunta, PDO::PARAM_STR);
            $stmt->bindValue(':PrimeiraResposta', $resposta->PrimeiraResposta, PDO::PARAM_STR);
            

            $stmt->execute();
            //echo " \n linhas:" . $stmt->rowCount() . "\n";
            return true;
       }
       catch(PDOException $e){
            header('Content-Type: application/json; charset=UTF-8');
            header('HTTP/1.1 500 Internal Server error{'.$e->getMessage().'}');
            //echo "Execute Failed:  ". $e->getMessage();
       }
    }


    function Salvar(){
        $IdPessoa = InserirPessoa();

        if($IdPessoa != null && $IdPessoa != "")
        {
            return InserirResposta($IdPessoa);
        }
        return false;
    }

    function VerificaPessoa($pessoa){
        try{
            $username = "natan";
            $password = "pre1958@@";

            $con = new PDO("mysql:host=10.0.40.38;dbname=cadastro_pat", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, $con::ERRMODE_EXCEPTION);

            $stmt= $con->prepare("SELECT COUNT(*) FROM pessoa WHERE Cpf = :Cpf LIMIT 1"); 
            /*  $stmt= $con->prepare("SELECT COUNT(*) FROM pessoa WHERE Cpf = :Cpf LIMIT 1"); */
            $stmt->execute([':Cpf' => $pessoa->Cpf]); 

            $count = $stmt->fetchColumn();

            // if($count != 0)
            // {
            //     echo "Seu cadastro já foi encontrada em nosso sistema, muito obrigado!";
            //     return true;
            // }
            // else{
            //     return false;
            // }
        }
        catch(PDOException $e){
            header('Content-Type: application/json; charset=UTF-8');
            header('HTTP/1.1 500 Internal Server error{'.$e->getMessage().'}');
            //echo "Execute Failed:  ". $e->getMessage();
        }
    }

    
    
?>