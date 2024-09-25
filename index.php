<?php

class Livro {
    public $id;
    public $titulo;
    public $autor;
    public $anoPublicacao;

    public function __construct($id, $titulo, $autor, $anoPublicacao) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $anoPublicacao;
    }

    public static function criar($id, $titulo, $autor, $anoPublicacao, &$livros) {
        $novoLivro = new Livro($id, $titulo, $autor, $anoPublicacao);
        $livros[$id] = $novoLivro;
        echo "Livro '$titulo' adicionado com sucesso!\n";
    }

    public function exibir() {
        return "ID: " . $this->id . " | Título: " . $this->titulo . " | Autor: " . $this->autor . " | Ano de Publicação: " . $this->anoPublicacao;
    }

    public function atualizar($titulo, $autor, $anoPublicacao) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $anoPublicacao;
        echo "Livro ID " . $this->id . " atualizado com sucesso!\n";
    }

    public static function deletar($id, &$livros) {
        if (isset($livros[$id])) {
            unset($livros[$id]);
            echo "Livro com ID $id foi deletado com sucesso!\n";
        } else {
            echo "Livro com ID $id não encontrado.\n";
        }
    }
}

function exibirLivros($livros) {
    if (empty($livros)) {
        echo "Nenhum livro encontrado.\n";
    } else {
        foreach ($livros as $livro) {
            echo $livro->exibir() . "\n";
        }
    }
}

function menu() {
    echo "\nEscolha uma opção:\n";
    echo "1 - Adicionar Livro\n";
    echo "2 - Exibir Livros\n";
    echo "3 - Atualizar Livro\n";
    echo "4 - Deletar Livro\n";
    echo "5 - Sair\n";
    return readline("Digite o número da opção desejada: ");
}

$livros = array();

while (true) {
    $opcao = menu();

    switch ($opcao) {
        case 1:
            $id = readline("Digite o ID do livro: ");
            $titulo = readline("Digite o título do livro: ");
            $autor = readline("Digite o autor do livro: ");
            $anoPublicacao = readline("Digite o ano de publicação do livro: ");
            Livro::criar($id, $titulo, $autor, $anoPublicacao, $livros);
            break;

        case 2: 
            echo "\nLista de livros:\n";
            exibirLivros($livros);
            break;

        case 3: 
            $id = readline("Digite o ID do livro que deseja atualizar: ");
            if (isset($livros[$id])) {
                $titulo = readline("Digite o novo título: ");
                $autor = readline("Digite o novo autor: ");
                $anoPublicacao = readline("Digite o novo ano de publicação: ");
                $livros[$id]->atualizar($titulo, $autor, $anoPublicacao);
            } else {
                echo "Livro com ID $id não encontrado.\n";
            }
            break;

        case 4: 
            $id = readline("Digite o ID do livro que deseja deletar: ");
            Livro::deletar($id, $livros);
            break;

        case 5: 
            echo "Encerrando o programa...\n";
            exit();

        default: 
            echo "Opção inválida! Por favor, tente novamente.\n";
    }
}
?>
