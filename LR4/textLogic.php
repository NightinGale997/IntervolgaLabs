<?php
$inputText = $_POST['textarea'];
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<div>'. mb_convert_encoding($inputText, 'HTML-ENTITIES', 'UTF-8') .'</div>',LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
$replacedDotsInTexts = DotsReplacement($dom);
$htmlWithoutRecurringStyles = RecurringClasses($dom);
$replacedDashesInTexts = DashReplacement($dom);
$headersWithHtml = GenerateHeaders($inputText);
$images = GetImagesFromText($dom);

function GetImagesFromText($dom)
{
    $source = [];
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        $source[] = $src;
    }
    return $source;
}

function DashReplacement($dom)
{
    $text = $dom->textContent;
    $replaced = preg_replace(['/\s-\s/u', '/\s--\s/u'], [' &ndash; ', '&nbsp;&mdash; '], $text);
    return ($replaced !== $text) ? $replaced : '';
}

function DotsReplacement($dom)
{
    $text = $dom->textContent;
    $replaced = preg_replace(['/\bитд\b/ui', '/\bитп\b/ui'], ['и т.д.', 'и т.п.'], $text);
    return ($replaced !== $text) ? $replaced : '';
}

function GenerateHeaders($content): array
{
    preg_match_all('#<h([1-6])[^>]*>(.*?)</h[1-6]>#', $content, $matches, PREG_SET_ORDER);
    $toc = array();
    foreach ($matches as $match) {
        $level = $match[1];
        $text = $match[2];
        if (mb_strlen($text) > 50) {
            $text = mb_substr($text, 0, 50) . '...';
        }
        $text = strip_tags($text);
        $id = 'toc_' . uniqid();
        $toc[] = array(
            'level' => $level,
            'text' => $text,
            'id' => $id
        );
        $content = str_replace($match[0], "<h{$level} id='{$id}'>{$match[2]}</h{$level}>", $content);
    }

    $toc_html = '';

    $current_level = 0;

    foreach ($toc as $item) {
        $level = $item['level'];
        $text = $item['text'];
        $id = $item['id'];

        if ($level > $current_level) {
            $toc_html .= '<ul>';
        }

        if ($level < $current_level) {
            $toc_html .= '</li></ul>';
        }

        if ($level == $current_level) {
            $toc_html .= '</li>';
        }

        $toc_html .= "<li><a href='#{$id}'>{$text}</a>";

        $current_level = $level;
    }

    while ($current_level > 0) {
        $toc_html .= '</li></ul>';
        $current_level--;
    }
    return [$toc_html, $content];
}

function RecurringClasses($dom)
{
    $replaces = [];
    $elementsByTagName = $dom->getElementsByTagName('*');
    $recurringStyles = FindRecurringStyles($elementsByTagName);
    foreach ($elementsByTagName as $element) {
        $elementStyles = $element->getAttribute('elementStyles');
        if (!empty($elementStyles)) {
            if(array_key_exists($elementStyles,$recurringStyles) && $recurringStyles[$elementStyles] >1){
                $generatedClass= GenerateClassFromStyle($elementStyles);
                $existingClass = $element->getAttribute('class');
                $element->setAttribute('class',$generatedClass.' '.$existingClass);
                $element->removeAttribute('elementStyles');
            }
        }
    }

    foreach ($recurringStyles as $key=>$value){
        if($value > 1){
            $generatedClass = GenerateClassFromStyle($key);

            $styleElement = $dom->createElement('elementStyles');
            $styleText = "$generatedClass { $key }";
            $styleElement->appendChild($dom->createTextNode($styleText));

            $firstChild = $dom->firstChild;
            $dom->insertBefore($styleElement, $firstChild);
            $dom->insertBefore($dom->createTextNode("\n"), $firstChild);
            $replaces[] = "added";
        }
    }

    return !$replaces ? [] : nl2br(htmlspecialchars(html_entity_decode($dom->saveHTML())));
}

function GenerateClassFromStyle ($style): string
{
    $styleRules =explode(';',$style);
    $class = '';
    foreach ($styleRules as $styleRule){
        $ruleParts = array_map('trim', explode(':', $styleRule));
        foreach($ruleParts as $rule){
            $part = preg_replace('/[^a-zA-Z0-9]/', '', $rule);
            $class .= $part;
        }
    }
    return $class;
}

function FindRecurringStyles($elements): array
{
    $recurringStyles = [];
    foreach ($elements as $element) {
        $style = $element->getAttribute('style');
        if(!empty($style)){
            if(array_key_exists($style,$recurringStyles)){
                $recurringStyles[$style]++;
            }
            else{
                $recurringStyles[$style] = 1;
            }
        }
    }
    return $recurringStyles;
}