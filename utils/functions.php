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

        // Se não houver identificador
        if ($identificador === null) :

            // Loop percorrendo cada par de chave => valor do $novoRegistro.
            foreach ($novoRegistro as $key => $value) :

                // Verificando se há um campo chamado 'senha' no registro (com if short-circuit) e criptografando a senha
                $key === "senha"
                    && $novoRegistro[$key] = password_hash($value, PASSWORD_DEFAULT);

            endforeach;

            // $novoRegistroObj = (object) $novoRegistro;
            // var_dump(($novoRegistroObj));
            // exit;

            // Adição do objeto ao $$indice
            array_push($$indice, $novoRegistro);

            $jsonTemporario = getJson($arquivo);

            // Percorre cada objeto do índice declarado no parâmetro 1
            foreach ($jsonTemporario as $indicesNivelUm => $objetos) :

                // Checa se o $indice coincide com algum dos índices de primeiro nível
                if ($indicesNivelUm === $indice) :

                    // Atualiza o índice de acordo com o novo índice
                    $jsonTemporario[$indicesNivelUm] = $$indice;

                // else :

                //     // Descrição do erro caso não haja coincidência entre busca e registros
                //     $erro = "Registro não localizado";

                //     // Atrelando o erro ao $retorno
                //     $retorno = $erro;

                endif;

            endforeach;

        endif;

        // Transforma o array em JSON
        $jsonAtualizado = json_encode($jsonTemporario);
        // var_dump($jsonAtualizado);
        // exit;

        // Captura conteúdo do arquivo declarado no parâmetro 1
        $conteudoAtualizado = file_put_contents($arquivo, $jsonAtualizado);

        // Condicional if no estilo short-circuit, onde o && determina a ação no caso da condição ser verdadeira e o || caso a condição seja falsa
        $conteudoAtualizado
            && $retorno = true
            || $retorno = false;

    endif;

    // Retorna o $retorno
    return $retorno;
};
