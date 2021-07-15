<?Php 

    class Resposta    {
        
        
        var $Id;
        var $IdPessoa;
        var $PrimeiraPergunta;
        var $PrimeiraResposta;
        
        
        function __construct($IdPessoa, $PrimeiraPergunta, $PrimeiraResposta)
         {
            $this->Id = guidv4();
            $this->IdPessoa = $IdPessoa;
            $this->PrimeiraPergunta = $PrimeiraPergunta;
            $this->PrimeiraResposta = $PrimeiraResposta;
        }
    }
?>