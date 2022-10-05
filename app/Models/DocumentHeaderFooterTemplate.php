<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentHeaderFooterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'title', 'header_file', 'footer_file', 'is_organization_default'
    ];

    protected $appends = array('header_file_src', 'footer_file_src');

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /*
    * Get header file content
    */
    public function getHeaderFileSrcAttribute()
    {
        $folder = getUserOrganizationFilePath('files');

        $path = "{$folder}/{$this->header_file}";
        $file = Storage::disk('local')->get($path);
        Log::info($path);
        return $path;//base64_decode($file);
    }

    /*
    * Get footer file content
    */
    public function getFooterFileSrcAttribute()
    {
        $folder = getUserOrganizationFilePath('files');

        $path = "{$folder}/{$this->footer_file}";
        $file = Storage::disk('local')->get($path);
        Log::info($path);
        return $path;//base64_decode($file);
    }
}
