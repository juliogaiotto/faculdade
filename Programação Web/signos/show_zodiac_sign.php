<?php
include('layouts/header.php');
// Recebe a data digitada pelo usuário
$data_nascimento = $_POST['data_nascimento'];

function consultar_signo($data_usuario, $arquivo_xml) {
    // Carrega o arquivo XML em um objeto
    $xml = simplexml_load_file($arquivo_xml);
    $data_exibir = date("d/m/Y", strtotime($data_usuario));
    $ano = date("Y", strtotime($data_usuario));
    $data_digitada = strtotime($data_usuario);

    // Itera sobre cada elemento "signo" no XML
     foreach ($xml->signo as $signo) {
        // Formata as datas de início e fim do signo
        $data_inicio = (string)$signo->dataInicio . '/' . $ano;
        $data_fim = (string)$signo->dataFim . '/' . $ano;
        
        $data = DateTime::createFromFormat('d/m/Y', $data_inicio);
        $data_inicio = $data->format('Y-m-d');
        $data = DateTime::createFromFormat('d/m/Y', $data_fim);
        $data_fim = $data->format('Y-m-d');
        $data_inicio = strtotime($data_inicio);
        $data_fim = strtotime($data_fim);

        // Verifica se a data do usuário está entre as datas do signo usando as datas convertidas em numeros inteiros
        if ($data_digitada >= $data_inicio && $data_digitada <= $data_fim) {
            
             return [
                 'data' => (string)$data_exibir,
                 'signoNome' => (string)$signo->signoNome,
                 'descricao' => (string)$signo->descricao,
             ];
         }
         // Se nenhum signo foi encontrado, retorna uma mensagem
        }
    return "<p>Data inválida ou signo não encontrado.</p>";
}

// Chama a função para consultar o signo
$resultado = consultar_signo($data_nascimento, 'signos.xml');
// Exibe o resultado
if (is_array($resultado)) {
    echo '<div class="container text-center align-items-center">'.
         '<div class="row">'.
         '<div class="col-lg-3 mx-auto">'.
         '<div class="p-2">'.
         '<h4>Seu signo é...</h4>';
         echo "<h2>" . $resultado['signoNome'] . "</h2>";
         echo "<p>Descrição: " . $resultado['descricao']."</p>";
         echo "<p>Data informada: " . $resultado['data']."</p>";
    echo '</div></div></div></div>';
} else {
    echo $resultado;
}
include('layouts/footer.php');