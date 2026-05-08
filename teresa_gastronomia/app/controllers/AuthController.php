<?php
session_start();
require_once __DIR__ . '/../models/Database.php';

class AuthController {
    
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);
            
            $db = DB::getInstance();
            $user = $db->fetchOne("SELECT * FROM usuarios WHERE email = ? AND senha = ?", [$email, $senha]);
            
            if($user) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nome'] = $user['nome'];
                $_SESSION['usuario_tipo'] = $user['tipo'];
                $_SESSION['usuario_email'] = $user['email'];
                $_SESSION['filial_id'] = $user['filial_id'];
                
                if($user['tipo'] == 'matriz') {
                    header("Location: index.php?action=matriz_dashboard");
                } else {
                    header("Location: index.php?action=filial_dashboard");
                }
                exit();
            } else {
                $_SESSION['erro'] = "E-mail ou senha inválidos!";
                header("Location: index.php?action=login");
                exit();
            }
        }
        
        include __DIR__ . '/../views/login.php';
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
    
    public function verificarAutenticacao() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
    }
    
    public function verificarPermissao($tipo) {
        $this->verificarAutenticacao();
        if($_SESSION['usuario_tipo'] != $tipo) {
            header("Location: index.php?action=" . $_SESSION['usuario_tipo'] . "_dashboard");
            exit();
        }
    }
}
?>