<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'is_active',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function getContentArrayAttribute(): array
    {
        return json_decode($this->content, true) ?? ['blocks' => []];
    }

    public function getContentTextAttribute(): string
    {
        $decoded = $this->content_array;
        $text = '';

        foreach ($decoded['blocks'] ?? [] as $block) {
            if (isset($block['data']['text'])) {
                $text .= strip_tags($block['data']['text']) . ' ';
            }
        }

        return trim($text);
    }

    public function getTagsAttribute(): array
    {
        $decoded = $this->content_array;
        $tags = [];

        foreach ($decoded['blocks'] ?? [] as $block) {
            $text = $block['data']['text'] ?? $block['data']['title'] ?? '';
            preg_match_all('/#(\w+)/u', $text, $matches);
            foreach ($matches[0] ?? [] as $tag) {
                $tags[] = $tag;
            }
        }

        return array_values(array_unique($tags));
    }

    public function renderContent(): string
    {
        $blocks = $this->content_array['blocks'] ?? [];
        $html = '';

        foreach ($blocks as $block) {
            $data = $block['data'] ?? [];
            $type = $block['type'] ?? '';

            switch ($type) {
                case 'header':
                    $level = $data['level'] ?? 2;
                    $text = $data['text'] ?? '';
                    if ($level <= 2) {
                        $html .= '<h2 class="font-headline-lg text-3xl md:text-4xl uppercase leading-tight mb-6">' . e($text) . '</h2>';
                    } elseif ($level <= 4) {
                        $html .= '<h3 class="font-headline-lg text-2xl md:text-3xl uppercase leading-tight mb-4">' . e($text) . '</h3>';
                    } else {
                        $html .= '<h4 class="font-headline-lg text-xl uppercase leading-tight mb-3">' . e($text) . '</h4>';
                    }
                    break;

                case 'paragraph':
                    $text = $data['text'] ?? '';
                    $html .= '<p class="font-body-md text-base md:text-lg leading-relaxed mb-6">' . e($text) . '</p>';
                    break;

                case 'list':
                    $style = $data['style'] ?? 'unordered';
                    $items = $data['items'] ?? [];
                    if ($style === 'ordered') {
                        $html .= '<ol class="list-decimal pl-6 space-y-2 mb-6 font-body-md">';
                    } else {
                        $html .= '<ul class="list-disc pl-6 space-y-2 mb-6 font-body-md">';
                    }
                    foreach ($items as $item) {
                        $html .= '<li>' . e($item) . '</li>';
                    }
                    $html .= ($style === 'ordered') ? '</ol>' : '</ul>';
                    break;

                case 'quote':
                case 'blockquote':
                    $text = $data['text'] ?? '';
                    $caption = $data['caption'] ?? '';
                    $html .= '<blockquote class="bg-on-background text-surface p-8 border-3 border-on-background brutalist-shadow italic relative overflow-hidden mb-6">';
                    $html .= '<span class="material-symbols-outlined absolute -top-4 -left-4 text-9xl opacity-20 rotate-12">format_quote</span>';
                    $html .= '<p class="text-xl md:text-2xl font-bold relative z-10">' . e($text) . '</p>';
                    if ($caption) {
                        $html .= '<footer class="mt-4 font-label-mono text-xs uppercase opacity-70 relative z-10">— ' . e($caption) . '</footer>';
                    }
                    $html .= '</blockquote>';
                    break;

                case 'delimiter':
                    $html .= '<hr class="border-3 border-on-background my-10">';
                    break;

                default:
                    if (isset($data['text'])) {
                        $html .= '<p class="font-body-md mb-6">' . e($data['text']) . '</p>';
                    }
                    break;
            }
        }

        return $html;
    }
}