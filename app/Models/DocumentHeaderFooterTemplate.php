<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentHeaderFooterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'title', 'header_file', 'footer_file', 'is_organization_default'
    ];

    protected $appends = [
        'header_file_url',
        'footer_file_url',
    ];

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Returns temporary URL for header file
     */
    public function getHeaderFileUrlAttribute()
    {
        if ($this->header_file) {
            if (config('filesystems.default') !== 's3') {
                return url($this->header_file);
            }

            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->header_file, now()->addMinutes($expiry));
        }
    }

    /**
     * Returns temporary URL for footer file
     */
    public function getFooterFileUrlAttribute()
    {
        if ($this->footer_file) {
            if (config('filesystems.default') !== 's3') {
                return url($this->footer_file);
            }

            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->footer_file, now()->addMinutes($expiry));
        }
    }
}
