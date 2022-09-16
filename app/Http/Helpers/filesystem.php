<?php

use App\Enum\FileType;

if (!function_exists('getFileName')) {
    function getFileName(FileType $type, $id, $extension, $name = null)
    {
        $filename = "{$type->value}_{$id}";

        if ($name) {
            $filename += "_{$name}";
        }

        $filename += ".{$extension}";

        return $filename;
    }
}

if (!function_exists('getModelIdFromFilename')) {
    function getModelIdFromFilename($prefix, $filename) {
        $filename = str_replace($prefix, '', $filename);
        $file_parts = explode('_', $filename);

        return $file_parts[1];
    }
}
