<?php

namespace App\Kernel;

class View
{
    public static function Create($viewName, $params = [])
    {
        $viewFinal = "";
        $endSectionTemplate = 0;
        do {
            ob_start();
            include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $viewName . '.view.php';
            $content_layout = ob_get_clean();

            $requireFileNameTemplateImport = Self::findParameter($content_layout, '@php-mvc-import-template(')['params'];

            ob_start();
            include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' .
                DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR
                . $requireFileNameTemplateImport . '.template.php';
            $Imported_content_layout_template = ob_get_clean();

            $content_layout = str_replace('@php-mvc-import-template(' .
                $requireFileNameTemplateImport . ')',
                $Imported_content_layout_template, $content_layout);
            $paramTemplateSection = Self::findParameter($content_layout, '@php-mvc-section(');
            if ($endSectionTemplate < strpos($content_layout, "@php-mvc-end-section", $paramTemplateSection['end'])) {
                $endSectionTemplate = strpos($content_layout, "@php-mvc-end-section", $paramTemplateSection['end']);
            } else {
                break;
            }
            $sectionParams = "";
            for ($i = $paramTemplateSection['end'] + 1; $i < $endSectionTemplate; $i++) {
                $sectionParams .= $content_layout[$i];
            }
//            for ($i = 5158 ; $i < 5158; $i++) {
//                echo $content_layout[$i];
//            }
            $viewFinal = str_replace('@php-mvc-yield(' . $paramTemplateSection['params'] . ')', $sectionParams, $Imported_content_layout_template);
        } while ($endSectionTemplate != false);
        var_dump($endSectionTemplate);
        return $viewFinal;
    }

    static public function findParameter($content_layout, $strPhpMvcImport)
    {
        $positionImportStart = strpos($content_layout, $strPhpMvcImport);
        $positionImportStart += strlen($strPhpMvcImport);
        $positionImportEnd = strpos($content_layout, ")", $positionImportStart);
        $requireFileNameTemplateImport = '';
        for ($i = $positionImportStart; $i < $positionImportEnd; $i++) {
            $requireFileNameTemplateImport .= $content_layout[$i];
        }
        return [
            'params' => $requireFileNameTemplateImport,
            'start' => $positionImportStart,
            'end' => $positionImportEnd
        ];
    }
}
