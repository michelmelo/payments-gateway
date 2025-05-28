<?php

/**
 * Script para gerar um changelog com base nos commits do Git, incluindo tags.
 */

// Define o arquivo de saída do changelog
$outputFile = __DIR__ . '/../CHANGELOG.md';

// Executa o comando Git para obter os commits com tags (se houver)
exec('git log --pretty=format:"%h %ad %s %d" --date=short', $output);

// Verifica se há commits
if (empty($output)) {
    echo "Nenhum commit encontrado.\n";

    exit(1);
}

// Inicia o conteúdo do changelog
$changelog = "# Changelog\n\n";
$changelog .= "Todos os principais eventos e alterações neste projeto.\n\n";

// Adiciona os commits ao changelog
foreach ($output as $line) {
    // Limpa parênteses vazios se não houver tag
    $line = preg_replace('/\s+\(\)/', '', $line);
    $changelog .= '- ' . $line . "\n";
}

// Salva o changelog no arquivo
file_put_contents($outputFile, $changelog);

echo "Changelog gerado com sucesso em: $outputFile\n";
