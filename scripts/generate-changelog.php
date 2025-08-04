<?php

/**
 * Script para gerar um changelog com base nas tags do Git.
 */

// Define o arquivo de saída do changelog
$outputFile = __DIR__ . '/../CHANGELOG.md';

// Executa o comando Git para obter todas as tags ordenadas por data
exec('git tag -l --sort=-version:refname', $tags);

// Verifica se há tags
if (empty($tags)) {
    echo "Nenhuma tag encontrada.\n";
    exit(1);
}

// Inicia o conteúdo do changelog
$changelog = "# Changelog\n\n";
$changelog .= "Todos os principais eventos e alterações neste projeto.\n\n";

// Para cada tag, obtém os commits desde a tag anterior
for ($i = 0; $i < count($tags); $i++) {
    $currentTag = $tags[$i];
    $previousTag = isset($tags[$i + 1]) ? $tags[$i + 1] : null;
    
    // Obtém a data da tag
    exec("git log -1 --format=%ai $currentTag", $tagDateOutput);
    $tagDate = isset($tagDateOutput[0]) ? date('Y-m-d', strtotime($tagDateOutput[0])) : 'Unknown';
    unset($tagDateOutput);
    
    // Adiciona o cabeçalho da versão
    $changelog .= "## [$currentTag] - $tagDate\n\n";
    
    // Define o range de commits para esta tag
    if ($previousTag) {
        $commitRange = "$previousTag..$currentTag";
    } else {
        $commitRange = $currentTag;
    }
    
    // Obtém os commits para esta tag
    exec("git log --pretty=format:\"%h %s\" $commitRange", $commits);
    
    if (!empty($commits)) {
        foreach ($commits as $commit) {
            $changelog .= "- $commit\n";
        }
    } else {
        $changelog .= "- Nenhuma alteração registrada\n";
    }
    
    $changelog .= "\n";
    unset($commits);
}

// Salva o changelog no arquivo
file_put_contents($outputFile, $changelog);

echo "Changelog gerado com sucesso em: $outputFile\n";
