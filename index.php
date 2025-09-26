<?php
// Arquivo: index.php

// 1. Coleta o link de destino
// O link é passado na URL como um parâmetro 'url'. Exemplo: site.com/?url=https://site-destino.com
$target_url = isset($_GET['url']) ? filter_var(urldecode($_GET['url']), FILTER_SANITIZE_URL) : '';

// 2. Define os dados do seu CTA (Personalize esta seção)
$cta_data = [
    'title' => 'Siga-me para mais Dicas!', // Título do seu CTA
    'button_text' => 'Visite Meu Site Agora', // Texto do Botão
    'button_link' => 'https://seusitepessoal.com.br', // Seu link principal (substitua)
    'brand_name' => 'Seu Nome ou Marca', // Nome exibido no CTA
    'cta_color' => '#1DA1F2', // Cor principal do CTA (Ex: Azul Twitter)
];

// Se nenhuma URL de destino válida for fornecida, redireciona para o seu site ou exibe um erro
if (empty($target_url) || !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $target_url)) {
    // Redireciona para sua página inicial se o link estiver inválido/faltando
    header('Location: ' . $cta_data['button_link']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cta_data['brand_name']; ?> | Conteúdo Compartilhado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div id="sniply-bar" style="background-color: <?php echo $cta_data['cta_color']; ?>;">
        <div class="cta-content">
            <span class="cta-brand"><?php echo $cta_data['brand_name']; ?></span>
            <span class="cta-message">
                <?php echo $cta_data['title']; ?>
            </span>
        </div>
        <a href="<?php echo $cta_data['button_link']; ?>" target="_blank" class="cta-button">
            <?php echo $cta_data['button_text']; ?>
        </a>
        <button id="close-cta" title="Fechar CTA (Fecha apenas a barra de CTA)">X</button>
    </div>

    <iframe src="<?php echo htmlspecialchars($target_url); ?>" frameborder="0" id="sniply-iframe"></iframe>

    <script>
        // Script para fechar o CTA
        document.getElementById('close-cta').addEventListener('click', function() {
            document.getElementById('sniply-bar').style.display = 'none';
            document.getElementById('sniply-iframe').style.top = '0'; // Move o iFrame para cima
        });
    </script>

</body>
</html>
