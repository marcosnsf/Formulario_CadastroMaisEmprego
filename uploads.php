<?php
//
// DEFINIÇÕES

// Tamanho máximo do arquivo (em bytes)
$tamanhoMaximo = 1000000;
// Extensões aceitas
$extensoes = array(".doc",".pdf",".docx");
// Caminho para onde o arquivo será enviado
$caminho = "uploads/";
// Substituir arquivo já existente (true = sim; false = nao)
$substituir = false;
    
    // Informações do arquivo enviado
    $nomeArquivo = $_FILES["file1"]["name"];
    $tamanhoArquivo = $_FILES["file1"]["size"];
    $nomeTemporario = $_FILES["file1"]["tmp_name"];
    
    // Verifica se o arquivo foi colocado no campo
    if (!empty($nomeArquivo)) {
        $erro = false;
    
        // Verifica se o tamanho do arquivo é maior que o permitido
        if ($tamanhoArquivo > $tamanhoMaximo) {
            $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
        } 
        // Verifica se a extensão está entre as aceitas
        elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
            $erro = "O arquivo <b>" . $nomeArquivo . "</b> não é válida";
        } 
        // Verifica se o arquivo existe e se é para substituir
        elseif (file_exists($caminho . $nomeArquivo) && !$substituir) {
            $erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
        }
    
        // Se não houver erro
        if (!$erro) {
            // Move o arquivo para o caminho definido
            if(move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo))){
                // Mensagem de sucesso
                echo "OK";
            } else {
                echo "arquivo não enviado ". $_FILES["file1"]["error"];
            }
        } 
        // Se houver erro
        else {
            // Mensagem de erro
            echo $erro . "<br />";
        }
    }

//
?>