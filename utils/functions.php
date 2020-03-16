<?php

/*
 *
 * NOTA: Esse arquivo foi criado para agrupar as funções, de modo a isolar as regras de negócio da interface com o usuário
 * 
 */

/*
 * 
 * Função que deve 'setar' nosso projeto
 * 
 * 1. Inicia uma session
 * 2. Define $ambiente (se quiser que seja 'desenvolvimento' utilize localhost na URL, caso contrário, utilize o IP - padrão é 127.0.0.1). Criaremos uma outra função para ativar o modo debug, que considerará o ambiente para ser inicializada.
 * 
 */
function init()
{

    // Iniciando sessão do usuário assim que uma página é carregada
    session_start();

    // Definindo o ambiente em que o projeto está rodando (com um if ternário)
    $_SERVER['SERVER_NAME'] === "localhost"
        ? $ambiente = "desenvolvimento"
        : $ambiente = "produção";

    return $ambiente;
}

/**
 * Captura de dados do JSON e transformação em Array
 * 
 * @param string $arquivo (opcional) -> Arquivo de onde será capturado o JSON. Caso não seja declarado um valor, consultará o arquivo ./data/dados.json. É fundamental que esse arquivo exista.
 * 
 * @return array Retorna um array com o conteúdo do JSON.
 * 
 * Obs.: deve ser chamada na página para 'devolver' o retorno.
 * 
 */
function getJson(string $arquivo = "./data/dados.json")
{

    // Função que verifica existência de um arquivo incluída como condição do if
    if (!file_exists($arquivo)) :

        // Erro gerado caso o arquivo não exista.
        $erro = "Arquivo não encontrado, por favor, verifique o nome e caminho do arquivo.";

        // Atribuição do erro ao retorno.
        $retorno = $erro;

    else :

        // Captura conteúdo do arquivo declarado no parâmetro 1
        $conteudo = file_get_contents($arquivo);

        // Transforma o conteúdo em array (sem o segundo parâmetro ou com ele como false retornaria um objeto)
        $retorno = json_decode($conteudo, true);

    endif;

    return $retorno;
}

/**
 * Consulta de registro(s) no JSON
 * 
 * @param string $indice -> Índice de primeiro nível a ser consultado (ex.: usuarios)
 * 
 * @param array $identificador (opcional) -> Array contendo a propriedade do registro a ser verificada e o valor a ser utilizado como condição. Valor default = null. Exemplo do parâmetro preenchido: ["email","fulano@dasilva.com"].
 * 
 * @param string $arquivo (opcional) -> Arquivo no qual está salvo o JSON que deve ser consultado. Caso não seja declarado um valor, consultará o arquivo ./data/dados.json.
 * 
 * @return array Retorna um objeto contendo os registros do índice primário que se enquadrem nas condições declaradas pelo segundo parâmetro
 * 
 * Obs.: deve ser chamada na página para 'devolver' o retorno.
 * 
 */
function getRegisters(string $indice, array $identificador = null, string $arquivo = "./data/dados.json")
{

    // Define o retorno de acordo com o parâmetro 3
    if ($identificador === null) :

        // Partimos do presuposto de que o índice não existe
        $encontrouIndice = false;

        // Verificamos se o índice existe
        $encontrouIndice = array_key_exists($indice, getJson($arquivo));

        // Se não encotnrarmos o índice
        if ($encontrouIndice === false) :

            // Declaramos o erro
            $erro = "Índice não encontrado";

            // E retornamos o erro
            return $erro;

            die;

        endif;

        // $retorno contém todos os objetos dentro do índice definido
        $retorno = getJson($arquivo)[$indice];

    else :

        // Percorre cada objeto do índice declarado no parâmetro 2
        foreach (getJson($arquivo)[$indice] as $registro) :

            // Checa se o identificador coincide com algum registro
            if ($registro[$identificador[0]] === $identificador[1]) :

                // $retorno contém um registro único
                $retorno = $registro;

                // Interrupção da condicional if
                break;

            else :

                // Descrição do erro caso não haja coincidência entre busca e registros
                $erro = "Registro não localizado";

                // Atrelando o erro ao $retorno
                $retorno = $erro;

            endif;

        endforeach;

    endif;

    // Retorna o $retorno
    return $retorno;

};

/**
 * Adiciona ou atualiza registro do JSON
 * 
 * @param string $indice -> Índice de primeiro nível onde o registro deve ser inserido (ex.: usuarios)
 *
 * @param array $novoRegistro -> Array contendo o objeto/registro a ser incluso. Exemplo do parâmetro preenchido: ["nome"=>"Marcelo","sobrenome"=>"Diament","email"=>"marcelo@diament.com", "senha"=>"123456789"]. Deve conter todos os campos preenchíveis.
 * 
 * @param array $identificador (opcional) -> Array contendo a propriedade do registro a ser verificada/atualizado e o valor a ser utilizado como parâmetro de busca. Valor default = null. Exemplo do parâmetro preenchido: ["email","fulano@dasilva.com"]. Se for null, adicionará um novo registro ao $indice declarado. Se definido, atualizará o registro encontrado de acordo com os campos declarados em $novoRegistro.
 * 
 * @param string $arquivo (opcional) -> Arquivo no qual está salvo o JSON que deve ser consultado. Caso não seja declarado um valor, consultará o arquivo ./data/dados.json.
 * 
 * @return boolean Retorna true caso o objeto seja inserido e false caso não.
 * 
 * Obs.: deve ser chamada na página para 'cadastrar' o objeto e retornar true ou false.
 * 
 */
function setRegister(string $indice, array $novoRegistro, array $identificador = null, string $arquivo = "./data/dados.json")
{

    // Define o retorno de acordo com o parâmetro 3
    if ($novoRegistro === null) :

        // Descrição do erro caso não haja coincidência entre busca e registros
        $erro = "Novo registro não capturado";

        // Atrelando o erro ao $retorno
        $retorno = $erro;

    else :

        // Criando uma 'variable variable', ou seja, o nome dessa variável será o valor do parâmetro $indice. Então se inserirmos 'usuarios' como índice, a variável se chamará $usuarios. Para usar esse recurso num 'echo' é necessário declarar dentro de chaves: ${$indice}.
        $$indice = getRegisters($indice, $identificador, $arquivo);

        // Verificamos se o índice existe
        $encontrouIndice = array_key_exists($indice, getJson($arquivo));

        // Se não encotnrarmos o índice
        if ($encontrouIndice === false) :

            // Declaramos o erro
            $erro = "Índice não encontrado";

            // E retornamos o erro
            return $erro;

            die;

        else :

            // Se não houver identificador
            if ($identificador === null) :

                // ID Máximo Inicial
                $idMax = 0;

                // Verificando cada um dos registros vindos de $$indice
                foreach ($$indice as $registro) :

                    // Se a chave for ID e for maior que o $idMax
                    $registro["id"] > $idMax
                        // Atribuímos o valor ao $idMax (if do tipo short-circuit) - ou seja, pegamos o maior ID existente no array de objetos, independente da ordem em que aparece
                        && $idMax = $registro["id"];

                endforeach;

                // Definimos o novo ID sendo uma unidade maior que o maior ID encontrado em $$indice
                $idNovo = ++$idMax;

                // Agora vamos inserir o $idNovo como primeiro item do novo registro somando o novo array ("id"=>$idNovo) com o array $novoRegistro original.
                $novoRegistro = array("id" => $idNovo) + $novoRegistro;

                // Loop percorrendo cada par de chave => valor do $novoRegistro.
                foreach ($novoRegistro as $key => $value) :

                    // Verificando se há um campo chamado 'senha' no registro (com if short-circuit)
                    $key === "senha"
                        // Criptografando a senha
                        && $novoRegistro[$key] = password_hash($value, PASSWORD_DEFAULT);

                endforeach;

                // Adição do objeto ao $$indice
                array_push($$indice, $novoRegistro);

                $jsonTemporario = getJson($arquivo);

                $jsonTemporario[$indice] = $$indice;

            // Se houver idenficiador... ou seja, se estivermos editando um registro...
            else :

                // Loop percorrendo cada par de chave => valor do $novoRegistro.
                foreach ($novoRegistro as $key => $value) :

                    // Verificando se há um campo chamado 'senha' no registro (com if short-circuit)
                    $key === "senha"
                        // Criptografando a senha
                        && $novoRegistro[$key] = password_hash($value, PASSWORD_DEFAULT);

                endforeach;

                $jsonTemporario = getJson($arquivo);

                // Percorre cada objeto do índice declarado no parâmetro 1
                foreach ($jsonTemporario as $indicesNivelUm => $objetos) :

                    // Checa se o $indice coincide com algum dos índices de primeiro nível
                    if ($indicesNivelUm === $indice) :

                        $indicesNivelUmNovo = [];

                        foreach ($jsonTemporario[$indicesNivelUm] as $objeto) :

                            // Se encontrarmos um email que coincida com o email enviado...
                            if ($objeto[$identificador[0]] === $identificador[1]) :

                                // Atrelamos os novos dados inseridos ao usuário encontrado (exceto pelo email, que é imutável e pelo ID, que não deve ser alterado - já está correto)
                                $objeto["nome"] = $novoRegistro["nome"];
                                $objeto["sobrenome"] = $novoRegistro["sobrenome"];
                                $objeto["senha"] = $novoRegistro["senha"];
                            endif;

                            array_push($indicesNivelUmNovo, $objeto);

                        endforeach;

                    endif;


                endforeach;

                $jsonTemporario[$indice] = $indicesNivelUmNovo;

            endif;

        endif;

        // Transforma o array em JSON
        $jsonAtualizado = json_encode($jsonTemporario);

        // Redefine o conteúdo do JSON
        $conteudoAtualizado = file_put_contents($arquivo, $jsonAtualizado);

        // Condicional if no estilo short-circuit, onde o && determina a ação no caso da condição ser verdadeira e o || caso a condição seja falsa
        $conteudoAtualizado
            && $retorno = true
            || $retorno = false;

    endif;

    // Retorna o $retorno
    return $retorno;
};

/**
 * Exclui registro do JSON
 * 
 * @param string $indice -> Índice de primeiro nível onde o registro deve ser inserido (ex.: usuarios)
 *  
 * @param array $identificador -> Array contendo a propriedade do registro a ser verificada e o valor a ser utilizado como parâmetro de busca.
 * 
 * @param string $arquivo (opcional) -> Arquivo no qual está salvo o JSON que deve ser consultado. Caso não seja declarado um valor, consultará o arquivo ./data/dados.json.
 * 
 * @return boolean Retorna true caso o objeto seja excluído e false caso não.
 * 
 * Obs.: deve ser chamada na página para excluir o objeto e retornar true ou false.
 * 
 */
function unsetRegister(string $indice, array $identificador, string $arquivo = "./data/dados.json")
{

    // Verificamos se o índice existe
    $encontrouIndice = array_key_exists($indice, getJson($arquivo));

    // Se não encotnrarmos o índice
    if ($encontrouIndice === false) :

        // Declaramos o erro
        $erro = "Índice não encontrado";

        // E retornamos o erro
        return $erro;

    else :

        // Criando uma 'variable variable', ou seja, o nome dessa variável será o valor do parâmetro $indice. Então se inserirmos 'usuarios' como índice, a variável se chamará $usuarios. Para usar esse recurso num 'echo' é necessário declarar dentro de chaves: ${$indice}.
        $$indice = getRegisters($indice, null, $arquivo);

        // Criando um array temporário para receber os objetos que permanecem
        $arrayTemporario = [];
        $usuarioExiste = false;

        for ($i = 0; $i < count($$indice); $i++) :

            // Se o identificador não corresponder com o identificador enviado...
            if ($$indice[$i][$identificador[0]] != $identificador[1]) :

                // Incluindo os objetos que devem permanecer
                array_push($arrayTemporario, $$indice[$i]);

            else :

                // Verificando se houve alguma correspondência entre o identificador e as propriedades dos objetos
                $usuarioExiste = true;

            endif;

        endfor;

        // Se não houver nenhuma correspondência,
        if ($usuarioExiste === false) :

            // Definimos um erro
            $erro = "Usuário não existe";

            // Retornamos o erro
            return $erro;

            // E travamos a função
            die;

        endif;

    endif;

    // Capturando o JSON completo
    $jsonTemporario = getJson($arquivo);

    // Atualizando o $indice do JSON temporário
    $jsonTemporario[$indice] = $arrayTemporario;

    // Transforma o array em JSON
    $jsonAtualizado = json_encode($jsonTemporario);

    // Insere o conteúdo atualizado
    $conteudoAtualizado = file_put_contents($arquivo, $jsonAtualizado);

    // Condicional if no estilo short-circuit, onde o && determina a ação no caso da condição ser verdadeira e o || caso a condição seja falsa
    $conteudoAtualizado
        && $retorno = true
        || $retorno = false;


    // Retorna o $retorno
    return $retorno;
}
