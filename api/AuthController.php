<?php
class AuthController {

    public function login() {
        global $pdo;

        $input = json_decode(file_get_contents("php://input"), true);

        $sql = "SELECT * FROM usuarios WHERE matricula = :mat AND senha = :senha LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":mat" => $input["matricula"],
            ":senha" => $input["senha"]
        ]);

        $u = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$u) {
            Response::json(401, "Credenciais inválidas");
        }

        session_start();
        $_SESSION['usuario_id'] = $u['id'];
        $_SESSION['nome']       = $u['nome'];
        $_SESSION['tipo']       = $u['tipo'];

        Response::json(200, "Login OK", [
            "id"   => $u['id'],
            "nome" => $u['nome'],
            "tipo" => $u['tipo']
        ]);
    }

    public function me() {
        $user = Auth::getUser();
        Response::json(200, null, $user);
    }
}
