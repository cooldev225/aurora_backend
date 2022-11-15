<?php

use App\Enum\FileType;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;

if (!function_exists('generateFileName')) {
    function generateFileName(FileType $type, $model_id, $extension, $name = null)
    {
        $filename = "{$type->value}_{$model_id}";

        if ($name) {
            $filename .= "_{$name}";
        }

        $filename .= ".{$extension}";

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

if (!function_exists('getUserOrganizationFilePath')) {
    function getUserOrganizationFilePath($prefix = 'files') {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        return "{$prefix}/{$user->organization_id}";
    }
}
