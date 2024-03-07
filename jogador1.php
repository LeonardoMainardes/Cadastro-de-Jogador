<?php
    class jogador
    {
        private int $id;
        private string $nome;
        private  string $user;
        private string $email;
        private string $senha;
        private string $data_cadastro;
            public function __construct($nome, $user, $email, $senha)
            {
                $this->nome = $nome;
                $this->user = $user;
                $this->email = $email;
                $this->senha = $senha;
                $this->data_cadastro = date('Y-m-d H:i:s');
            }
            public function getId(): int
            {
                return $this->id;
            }
            public function setId($id): void
            {
                $this->id = $id;
            }
            public function getNome(): string
            {
                return $this->nome;
            }
            public function setNome($nome): void
            {
                $this->nome = $nome;
            }
            public function getUser(): string
            {
                return $this->user;
            }
            public function setUser($user): void
            {
                $this->user = $user;
            }
            public function getEmail(): string
            {
                return $this->email;
            }
            public function setEmail($email): void
            {
                $this->email = $email;
            }
            public function getSenha(): string
            {
                return $this->senha;
            }
            public function setSenha($senha): void
            {
                $this->senha = $senha;
            }
            public function getData_Cadastro(): string
            {
                return $this->data_cadastro;
            }
            public function setData_Cadastro($data_cadastro): void
            {
                $this->data_cadastro = $data_cadastro;
            }
            public function save(): void
            {
                try {
                    $db = new PDO('sqlite:player1.db');

                    $query = $db->prepare("INSERT INTO jogador (nome, user, email, senha, data_cadastro) VALUES (:nome, :user, :email,:senha, :data_cadastro)");
                    $query->bindParam(':nome', $this->nome);
                    $query->bindParam(':user', $this->user);
                    $query->bindParam(':email', $this->email);
                    $query->bindParam(':senha', $this->senha);
                    $query->bindParam(':data_cadastro', $this->data_cadastro);

                    $resultado = $query->execute();

                    if ($resultado) {
                        echo "Sucesso: Registro inserido no banco de dados.";
                    } else {
                        echo "Erro durante a inserção no banco de dados.";
                    }
                }   catch (Exception $e) {
                    error_log("Erro durante a inserção no banco de dados: " . $e->getMessage());
                }
            }
            public function update(): void
            {
                try {
                    $db = new PDO('sqlite:player1.db');

                    $query = $db->prepare("UPDATE jogador SET nome = :nome, user = :user, email = :email, senha = :senha WHERE id = :id");
                    $query->bindParam(':id', $this->id);
                    $query->bindParam(':nome', $this->nome);
                    $query->bindParam(':user', $this->user);
                    $query->bindParam(':email', $this->email);
                    $query->bindParam(':senha', $this->senha);

                    $resultado = $query->execute();

                    if ($resultado) {
                        echo "Sucesso: Dados do jogador atualizados no banco de dados.";
                    } else {
                        echo "Erro durante a atualização no banco de dados.";
                    }
                } catch (Exception $e) {
                    error_log("Erro durante a atualização no banco de dados: " . $e->getMessage());
                }
            }
            public function delete(): void
            {
                try {
                    $db = new PDO('sqlite:player1.db');

                    $query = $db->prepare("DELETE from jogador WHERE id = :id"  );
                    $query->bindParam(':id', $id);

                    $resultado = $query->execute();

                    if ($resultado){
                        echo "Sucesso: jogador excluído do banco de dados.";
                    } else {
                        echo "Erro durante a exclusão no bando de dados.";
                    }
                }   catch  (Exception $e){
                    error_log("Erro durante a exclusão do banco de dados");
                }
            }
            public function getJogadorById($id)
            {
                try {
                    $db = new PDO('sqlite:player1.db');

                    $query = $db->prepare("SELECT * FROM jogador WHERE id = :id");
                    $query->bindParam(':id', $id);
                    $query->execute();

                    return $query->fetch(PDO::FETCH_ASSOC);

                } catch (Exception $e) {
                    error_log("Erro ao buscar jogador no banco de dados: " . $e->getMessage());
                    return false;
                }
            }
            public function getAll(): void
            {

            }
        }
    if (!empty($_GET['nome']) && !empty($_GET['user']) && !empty($_GET['email']) && !empty($_GET['senha'])) {
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $user = $_GET['user'];
        $email = $_GET['email'];
        $senha = $_GET['senha'];

        $jogador = new jogador($nome, $user, $email, $senha);

        $jogador->save();

    }