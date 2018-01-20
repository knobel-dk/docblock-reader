<?php

/**
 * Helper to remove newlines, inline comments and special chars
 */
const REMOVE_PATTERNS = [
    'inline_comment' => "~\/\/.+\n~",
    'residue_docblock' => "~\*|\/|~",
    'newlines' => "~\n~",
];

function sanitizeArray($arg) {
    if(!is_array($arg)) {
        foreach (REMOVE_PATTERNS as $key => $value) {
            $arg = preg_replace($value, "", $arg);
        }
        $arg = preg_replace('/(\s\s+|\t|\n)/', ' ', $arg);
        return trim($arg);
    }
    return array_map('sanitizeArray', $arg);
}

/** Regular expressions **/
const DOCKBLOCK = "~ {4}\/\*\*(\n[\w\W]*?)\*\/~";
const CODE = "~ {4}\*\/(\n[\w\W]*?)(\/\*\*|}\n*}|;\n*})~";

$parsed = 0;
$skipped = 0;

$iterator = new RecursiveDirectoryIterator('data');
foreach (new RecursiveIteratorIterator($iterator) as $name => $file) {

    if($file->getExtension() == "php") {

        $subject = file_get_contents($name);

        preg_match_all(DOCKBLOCK, $subject, $docblocks);
        preg_match_all(CODE, $subject, $codes);

        $snippets = sanitizeArray($codes[0]);
        $comments = sanitizeArray($docblocks[0]);

        if(empty($comments) || empty($snippets) ) {
            continue;
        }

        if(count($snippets) != count($comments)) {
            $skipped = $skipped + 1;
            continue;
        }

        file_put_contents('snippets.dat', implode("\n", $snippets), FILE_APPEND | LOCK_EX);
        file_put_contents('comments.dat', implode("\n", $comments), FILE_APPEND | LOCK_EX);
        $parsed = $parsed + 1;
    }
}

$success = sprintf("%.2f%%", $parsed/($parsed+$skipped)*100);
$fail = sprintf("%.2f%%", $skipped/($parsed+$skipped)*100);
echo "$parsed files parsed ($success) and skipped $skipped files ($fail).\n";