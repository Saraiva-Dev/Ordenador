<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Ordenador de Números</title>
</head>
<body>
    <div class="container">
        <h1>Ordenador de Números</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="file">Selecione um arquivo .txt:</label>
            <input type="file" name="file" id="file" accept=".txt" required>
            <label for="order">Tipo de Ordenação:</label>
            <select name="order" id="order">
                <option value="asc">Crescente</option>
                <option value="desc">Decrescente</option>
            </select>
            <button type="submit">Ordenar</button>
        </form>
        
        <?php
        //verificar se a requisição foi via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //verifica a existencia do arquivo e se o upload foi realizado (UPLOAD_ERR_OK)
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $order = $_POST['order'];
                
                // Lê o conteúdo do arquivo
                $fileContent = file_get_contents($fileTmpPath);
                // Converte a sequência em um array de números
                $numbers = array_map('intval', explode(' ', trim($fileContent)));

                // Ordena o array
                if ($order === 'asc') {
                    sort($numbers);
                } else {
                    rsort($numbers);
                }

                // Exibe os números ordenados
                echo "<h2>Números Ordenados (" . ($order === 'asc' ? "Crescente" : "Decrescente") . "):</h2>";
                echo "<div class='result'>" . implode(', ', $numbers) . "</div>";
            } else {
                echo "<p class='error'>Erro ao carregar o arquivo. Certifique-se de que é um arquivo .txt válido.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
