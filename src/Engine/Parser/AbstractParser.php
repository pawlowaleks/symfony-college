<?php

namespace App\Engine\Parser;

use App\Engine\Entity\AbstractEntity;

abstract class AbstractParser implements ParserInterface
{
    /**
     * Убрать из текста лишние пробелы, но оставить перевод строки
     * @param string|null $text
     * @return string|null
     */
    protected static function trimText(?string $text): ?string
    {
        if (empty($text)) {
            return null;
        }
        $trimmedText = trim(preg_replace('/\h{2,}/', ' ', $text));

        $result = null;
        $count = 0;
        $lines = explode("\n", $trimmedText);
        foreach ($lines as $row) {
            $row = trim($row);
            if (empty($row)) {
                $count++;
                continue;
            }
            if ($count > 0) {
                $result .= "\n";
            }
            $result .= $row;
            $count++;
        }
        return $result;
    }

    /**
     * @param string $url
     * @param string $content
     * @return AbstractEntity|null
     */
    abstract public function parse(string $url, string $content): ?AbstractEntity;
}