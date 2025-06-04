<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificador de Notícias com Gemini</title>
    <link rel="stylesheet" href="style.css">


</head>
<body>
    <div class="container">
        <h1>Verificador de Notícias</h1>
        <p class="subtitle">Use a inteligência artificial para obter uma análise inicial da notícia.</p>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><p><?= htmlspecialchars($error_message) ?></p></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="noticia">Cole a notícia aqui para análise:</label>
            <textarea name="noticia" id="noticia" rows="15" required><?= htmlspecialchars($noticia) ?></textarea>
            <button type="submit" class="btn">Verificar Notícia</button>
        </form>

        <?php if (!empty($analise_ia)): ?>
            <div class="result-box">
                <h2>Resultado da Análise da IA:</h2>
                <p class="disclaimer">
                    <strong>Aviso:</strong> Esta análise é gerada por IA e serve como um guia inicial. Verifique sempre fontes confiáveis.
                </p>
                <pre><?= htmlspecialchars($analise_ia) ?></pre>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
