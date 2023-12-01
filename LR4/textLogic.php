<?php

$inputText = $_POST['text'];
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<div>' . mb_convert_encoding($inputText, 'HTML-ENTITIES', 'UTF-8') . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

$source = getImagesFromText($dom);
$replacedTexts = replacement($dom);
$result = addHeadings($inputText);
if (!empty($result)) {
    $tableContent = $result;
}
$htmlWithoutRecurringStyles = recurringClasses($dom);
function getImagesFromText($dom)
{
    $source = [];
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        $source[] = $src;
    }
    return $source;
}

function replacement($dom)
{
    $text = $dom->textContent;
    $replacedText = preg_replace(['/\bитд\b/ui', '/\bитп\b/ui'], ['и т.д.', 'и т.п.'], $text);
    return ($replacedText !== $text) ? $replacedText : '';
}

function recurringClasses($dom)
{
    $replacements = [];
    $elements = $dom->getElementsByTagName('*');
    $recurringStyles = findRecurringStyles($elements);
    foreach ($elements as $element) {
        $style = $element->getAttribute('style');
        if (!empty($style)) {
            if (array_key_exists($style, $recurringStyles) && $recurringStyles[$style] > 1) {
                $generatedClass = generateClassFromStyle($style);
                $existingClass = $element->getAttribute('class');
                $element->setAttribute('class', $generatedClass . ' ' . $existingClass);
                $element->removeAttribute('style');
            }
        }
    }

    foreach ($recurringStyles as $key => $value) {
        if ($value > 1) {
            $generatedClass = generateClassFromStyle($key);

            $styleElement = $dom->createElement('style');
            $styleText = "$generatedClass { $key }";
            $styleElement->appendChild($dom->createTextNode($styleText));

            $firstChild = $dom->firstChild;
            $dom->insertBefore($styleElement, $firstChild);
            $dom->insertBefore($dom->createTextNode("\n"), $firstChild);
            $replacements[] = "added";
        }
    }

    return !$replacements ? [] : nl2br(htmlspecialchars(html_entity_decode($dom->saveHTML())));
}

function generateClassFromStyle($style)
{
    $styleRules = explode(';', $style);
    $class = '';
    foreach ($styleRules as $styleRule) {
        $ruleParts = array_map('trim', explode(':', $styleRule));
        foreach ($ruleParts as $rule) {
            $part = preg_replace('/[^a-zA-Z0-9]/', '', $rule);
            $class .= $part;
        }
    }
    return $class;
}

function findRecurringStyles($elements)
{
    $recurringStyles = [];
    foreach ($elements as $element) {
        $style = $element->getAttribute('style');
        if (!empty($style)) {
            if (array_key_exists($style, $recurringStyles)) {
                $recurringStyles[$style]++;
            } else {
                $recurringStyles[$style] = 1;
            }
        }
    }
    return $recurringStyles;
}

function generateTableOfContents($text)
{
    preg_match_all('/<h([1-3])>(.*?)<\/h\1>/', $text, $matches, PREG_SET_ORDER);
    $tableOfContents = '<ul>';
    foreach ($matches as $match) {
        $level = $match[1];
        $title = $match[2];
        $anchor = preg_replace('/\W+/', '-', strtolower($title));
        $shortTitle = (strlen($title) > 50) ? substr($title, 0, 50) . '...' : $title;
        $tableOfContents .= "<li><a href='#$anchor'>$shortTitle</a></li>";
        $text = str_replace($match[0], "<h$level id='$anchor'>$title</h$level>", $text);
    }
    $tableOfContents .= '</ul>';

    return ['tableOfContents' => $tableOfContents, 'text' => $text];
}

function addAnchorsToHeadings($text)
{
    return preg_replace('/<h([1-3])>(.*?)<\/h\1>/', '<h$1 id="$2">$3</h$1>', $text);
}

function addHeadings($inputHtml)
{
    $processedData = generateTableOfContents($inputHtml);
    $tableOfContents = $processedData['tableOfContents'];
    $processedText = $processedData['text'];
    $processedTextWithAnchors = addAnchorsToHeadings($processedText);
    return "<div class='processed-text'>" . $tableOfContents . $processedTextWithAnchors . "</div>";
}