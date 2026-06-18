<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CdnService
{
    protected string $uploadUrl = 'https://cdn.ryzahen.web.id/upload';

    /**
     * Upload file ke CDN
     *
     * @param UploadedFile $file
     * @return array|null ['success' => bool, 'url' => string, 'error' => string|null]
     */
    public function upload(UploadedFile $file): ?array
    {
        try {
            $response = Http::attach(
                'file',
                $file->getContent(),
                $file->getClientOriginalName()
            )->post($this->uploadUrl);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'url' => $data['url'] ?? null,
                    'filename' => $data['filename'] ?? null,
                    'size' => $data['size'] ?? null,
                ];
            }

            Log::error('CDN Upload Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'Upload gagal: ' . $response->status(),
            ];

        } catch (\Exception $e) {
            Log::error('CDN Upload Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Hapus file dari CDN (jika API mendukung DELETE)
     * Catatan: Berdasarkan halaman, tidak ada info tentang DELETE.
     * Jika tidak support, kita hanya hapus dari database saja.
     */
    public function delete(string $url): bool
    {
        // CDN.RYZAHEN sepertinya tidak support DELETE berdasarkan halaman.
        // Kita return true agar tidak error, tapi file tetap ada di CDN.
        // Ini adalah limitasi dari layanan ini.
        return true;
    }
}