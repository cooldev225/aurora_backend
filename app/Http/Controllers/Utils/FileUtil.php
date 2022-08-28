<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\FileManagement;

use App\Http\Constants\FileType;

class FileUtil extends Controller
{
    private static function getRandomFileName($fileName)
    {
        return time() . '_' . $fileName;
    }

    public static function getStoragePath($type)
    {
        switch($type)
        {
            case FileType::$ReferralFile:
                return 'files/appointment_referral';
                break;
            default:
                break;
        }
    }

    public static function getFileName($type, $id, $ext)
    {
        switch($type)
        {
            case FileType::$ReferralFile:
                return 'referral_file_' . $id . '.' . $ext;
                break;
            default:
                break;
        }
    }
}
