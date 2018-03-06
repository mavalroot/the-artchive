#!/usr/bin/env php
<?php

if (file_exists('vendor')) {
    require 'vendor/autoload.php';
} elseif (file_exists('../vendor')) {
    require '../vendor/autoload.php';
}

$issues = isset($argv[1]) && $argv[1] === '-i';

if ($issues) {
    echo "Se ha indicado la opción '-i'. Se actualizarán las incidencias en\n";
    echo "GitHub y se registrarán los enlaces correspondientes en los archivos\n";
    echo "'requisitos.md' y 'requisitos.xlsx' (en cambio, si el archivo\n";
    echo "'requisitos.xlsx' contiene ya las incidencias creadas, no se\n";
    echo "volverán a crear ni se modificarán en GitHub).\n\n";
    echo "¿Deseas continuar? (s/N): ";
    $sn = '';
    fscanf(STDIN, "%s", $sn);
    if ($sn !== 's' && $sn !== 'S') {
        exit(1);
    }
}

echo "Leyendo archivo requisitos.xlsx...\n";
\PhpOffice\PhpSpreadsheet\Settings::setLocale('es');
$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load("requisitos.xlsx");
$objWorksheet = $objPHPExcel->getSheet(0);
$highestRow = $objWorksheet->getHighestDataRow(); // e.g. 10
$highestColumn = $objWorksheet->getHighestDataColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
$requisitos = "\n# Catálogo de requisitos\n\n";
$resumen = "\n## Cuadro resumen\n\n"
         . '| **Requisito** | **Prioridad** | **Tipo** | **Complejidad** | **Entrega** |'
         . ($issues ? " **Incidencia** |" : '') . "\n"
         . '| :------------ | :-----------: | :------: | :-------------: | :---------: |'
         . ($issues ? " :------------: |" : '') . "\n";

$salida = `ghi`;
$matches = [];

if ($issues) {
    if (preg_match('%# ([^ ]+/[^ ]+)%', $salida, $matches) === 1) {
        $repo = $matches[1];
    } else {
        echo "Error: no se puede identificar el repositorio de GitHub asociado.\n";
        exit(1);
    }
}

for ($row = 2; $row <= $highestRow; $row++) {
    if (($row - 1) % 10 === 0) {
        echo "Deteniendo la ejecución por 10 segundos para evitar exceso de tasa...";
        sleep(10);
        echo "\n";
    }
    echo '(' . ($row - 1) . '/' . ($highestRow - 1) . ') ';
    $codigo      = $objWorksheet->getCell("A$row")->getValue();
    $corta       = $objWorksheet->getCell("B$row")->getValue();
    $larga       = $objWorksheet->getCell("C$row")->getValue();
    $largaMd     = preg_replace('/\n/u', ' ', $larga);
    $prioridad   = $objWorksheet->getCell("D$row")->getValue();
    $tipo        = $objWorksheet->getCell("E$row")->getValue();
    $complejidad = $objWorksheet->getCell("F$row")->getValue();
    $entrega     = $objWorksheet->getCell("G$row")->getValue();
    $incidencia  = $objWorksheet->getCell("H$row")->getValue();

    if ($issues) {
        if ($incidencia === null) {
            $mensaje = "($codigo) $corta\n$larga";
            $prioridadGhi = mb_strtolower($prioridad);
            $tipoGhi = mb_strtolower($tipo);
            $complejidadGhi = mb_strtolower($complejidad);
            $entregaGhi = mb_substr($entrega, 1, 1);
            $comando = "ghi open -m \"$mensaje\" --claim";
            if (!empty($prioridadGhi)
                && in_array($prioridadGhi, ['mínimo', 'importante', 'opcional'])) {
                $comando .= " -L $prioridadGhi";
            }
            if (!empty($tipoGhi)
                && in_array($tipoGhi, ['funcional', 'técnico', 'información'])) {
                $comando .= " -L $tipoGhi";
            }
            if (!empty($complejidadGhi)
                && in_array($complejidadGhi, ['fácil', 'media', 'difícil'])) {
                $comando .= " -L $complejidadGhi";
            }
            if (!empty($entregaGhi)
                && in_array($entregaGhi, ['1', '2', '3'])) {
                $comando .= " -M $entregaGhi";
            }
            echo "Generando incidencia para $codigo en GitHub...";
            $salida = `$comando`;
            $matches = [];
            if (preg_match('/^#([0-9]+):/', $salida, $matches) === 1) {
                $incidencia = $matches[1];
                $link = "https://github.com/$repo/issues/$incidencia";
                $objWorksheet->setCellValue("H$row", $incidencia);
                $objWorksheet->getCell("H$row")->getHyperlink()->setUrl($link);
                echo " #$incidencia\n";
            } else {
                echo "\nError: no se ha podido crear la incidencia en GitHub.\n";
                $link = '';
            }
        } else {
            echo "El requisito $codigo ya tiene asociada la incidencia #$incidencia.\n";
        }

        $link = "https://github.com/$repo/issues/$incidencia";
    }

    $requisitos .= "| **$codigo**     | **$corta**           |\n"
                 . "| --------------: | :------------------- |\n"
                 . "| **Descripción** | $largaMd             |\n"
                 . "| **Prioridad**   | $prioridad           |\n"
                 . "| **Tipo**        | $tipo                |\n"
                 . "| **Complejidad** | $complejidad         |\n"
                 . "| **Entrega**     | $entrega             |\n"
                 . ($issues ? "| **Incidencia**  | [$incidencia]($link) |" : '') . "\n\n";

    $resumen .= "| (**$codigo**) $corta | $prioridad | $tipo | $complejidad | $entrega |"
              . ($issues ? " [$incidencia]($link) |" : '') . "\n";
}

echo "Generando archivo requisitos.md...\n";
file_put_contents('requisitos.md', $requisitos . $resumen, LOCK_EX);

if ($issues) {
    echo "Actualizando archivo requisitos.xlsx...\n";
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
    $writer->save('requisitos.xlsx');
}
