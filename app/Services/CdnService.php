<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CdnService
{
    protected string $disk = 'public';
    protected string $path = 'images';

    public function upload(UploadedFile $file): ?array
    {
        try {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $stored = Storage::disk($this->disk)->putFileAs($this->path, $file, $filename);

            if ($stored) {
                return [
                    'success' => true,
                    'url' => '/storage/' . $this->path . '/' . $filename,
                    'filename' => $filename,
                    'size' => $file->getSize(),
                ];
            }

            return [
                'success' => false,
                'error' => 'Gagal menyimpan file.',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }

    public function delete(string $url): bool
    {
        $relativePath = ltrim(Str::after($url, '/storage/'), '/');

        if ($relativePath && Storage::disk($this->disk)->exists($relativePath)) {
            return Storage::disk($this->disk)->delete($relativePath);
        }

        return true;
    }
}
