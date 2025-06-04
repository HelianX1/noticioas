<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Models/GeminiService.php';

class NoticiaController {
    public function index() {
        $analise_ia = '';
        $error_message = '';
        $noticia = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['noticia'])) {
            $noticia = trim($_POST['noticia']);
            if (empty($noticia)) {
                $error_message = 'Por favor, insira o texto da notícia para verificação.';
            } elseif (strlen($noticia) > 3000) {
                $error_message = 'O texto da notícia é muito longo. Limite a 3000 caracteres.';
            } else {
                $resultado = GeminiService::analisarNoticia($noticia);
                if (isset($resultado['erro'])) {
                    $error_message = $resultado['erro'];
                } else {
                    $analise_ia = $resultado['resultado'];
                }
            }
        }

        include __DIR__ . '/../Views/form.php';
    }
}
?>