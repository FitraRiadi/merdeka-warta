<?php

namespace App\Models;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::retrieved(function ($announcement) {
            if ($announcement->expired_at && $announcement->expired_at->isPast()) {
                ActivityLog::log('EXPIRED', 'announcement', $announcement->id, "Pengumuman \"{$announcement->title}\" kedaluwarsa dan dihapus otomatis");
                $announcement->delete();
            }
        });
    }

    protected $fillable = [
        'title',
        'content',
        'type',
        'is_active',
        'expired_at',
        'announcement_category_id',
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function announcementCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AnnouncementCategory::class);
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

    private function renderText(string $text, bool $preserveLines = true): string
    {
        $text = str_replace(['<br>', '<br/>', '<br />'], "\n", $text);

        $text = preg_replace_callback(
            '/<a\s+(?:[^>]*?\s+)?href="([^"]*)"([^>]*)>(.*?)<\/a>/i',
            function ($m) {
                $url = $m[1];
                $inner = $m[3];

                $safeProtocols = ['http://', 'https://', 'mailto:', 'tel:', '#'];
                $safe = false;
                foreach ($safeProtocols as $protocol) {
                    if (str_starts_with(strtolower($url), $protocol)) {
                        $safe = true;
                        break;
                    }
                }

                $url = $safe ? e($url) : '#';
                $inner = e($inner);

                return '<a href="' . $url . '" class="text-primary underline hover:text-secondary transition-colors" target="_blank" rel="noopener noreferrer">' . $inner . '</a>';
            },
            $text
        );

        $text = strip_tags($text, '<b><i><u><s><strong><em><code><span><sub><sup><mark><del><a><br>');

        if ($preserveLines) {
            $text = nl2br($text);
        }

        return $text;
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
                        $html .= '<h2 class="font-headline-lg text-3xl md:text-4xl uppercase leading-tight mb-6">' . $this->renderText($text, false) . '</h2>';
                    } elseif ($level <= 4) {
                        $html .= '<h3 class="font-headline-lg text-2xl md:text-3xl uppercase leading-tight mb-4">' . $this->renderText($text, false) . '</h3>';
                    } else {
                        $html .= '<h4 class="font-headline-lg text-xl uppercase leading-tight mb-3">' . $this->renderText($text, false) . '</h4>';
                    }
                    break;

                case 'paragraph':
                    $text = $data['text'] ?? '';
                    $html .= '<p class="font-body-md text-base md:text-lg leading-relaxed mb-6">' . $this->renderText($text) . '</p>';
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
                        $text = is_array($item) ? ($item['content'] ?? '') : (string) $item;
                        $html .= '<li>' . $this->renderText($text) . '</li>';
                    }
                    $html .= ($style === 'ordered') ? '</ol>' : '</ul>';
                    break;

                case 'quote':
                case 'blockquote':
                    $text = $data['text'] ?? '';
                    $caption = $data['caption'] ?? '';
                    $html .= '<blockquote class="bg-on-background text-surface p-8 border-3 border-on-background brutalist-shadow italic relative overflow-hidden mb-6">';
                    $html .= '<span class="material-symbols-outlined absolute -top-4 -left-4 text-9xl opacity-20 rotate-12">format_quote</span>';
                    $html .= '<p class="text-xl md:text-2xl font-bold relative z-10">' . $this->renderText($text) . '</p>';
                    if ($caption) {
                        $html .= '<footer class="mt-4 font-label-mono text-xs uppercase opacity-70 relative z-10">— ' . $this->renderText($caption, false) . '</footer>';
                    }
                    $html .= '</blockquote>';
                    break;

                case 'image':
                    $url = $data['url'] ?? $data['file']['url'] ?? '';
                    $caption = $data['caption'] ?? '';
                    $stretched = $data['stretched'] ?? false;
                    $withBorder = $data['withBorder'] ?? true;
                    $withBackground = $data['withBackground'] ?? false;
                    if ($url) {
                        $stretchClass = $stretched ? '' : ' max-w-lg';
                        $html .= '<figure class="border-3 border-on-background brutalist-shadow mb-6' . $stretchClass . '">';
                        $html .= '<img class="w-full max-h-96 object-contain" src="' . e($url) . '" alt="' . e($caption ?: 'Announcement image') . '">';
                        if ($caption) {
                            $html .= '<figcaption class="bg-surface-container p-3 font-label-mono text-xs uppercase border-t-3 border-on-background">' . $this->renderText($caption, false) . '</figcaption>';
                        }
                        $html .= '</figure>';
                    }
                    break;

                case 'checklist':
                    $items = $data['items'] ?? [];
                    $html .= '<ul class="space-y-3 mb-6 font-body-md">';
                    foreach ($items as $item) {
                        $checked = $item['meta']['checked'] ?? $item['checked'] ?? false;
                        $text = $item['content'] ?? $item['text'] ?? '';
                        $html .= '<li class="flex items-center gap-3">';
                        $html .= $checked
                            ? '<span class="material-symbols-outlined text-secondary">check_circle</span>'
                            : '<span class="material-symbols-outlined text-on-surface-variant">radio_button_unchecked</span>';
                        $html .= '<span' . ($checked ? ' class="line-through opacity-60"' : '') . '>' . $this->renderText($text) . '</span>';
                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                    break;

                case 'delimiter':
                    $html .= '<hr class="border-3 border-on-background my-10">';
                    break;

                case 'button':
                    $text = !empty($data['text']) ? $data['text'] : 'Tombol';
                    $url = !empty($data['url']) ? $data['url'] : '#';
                    $style = !empty($data['style']) ? $data['style'] : 'primary';
                    $linkType = !empty($data['linkType']) ? $data['linkType'] : (!empty($data['download']) ? 'download' : 'link');
                    $download = ($linkType === 'download');
                    $icon = $download ? 'download' : 'link';
                    $styleClasses = [
                        'primary' => 'bg-primary text-on-primary border-2 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]',
                        'secondary' => 'bg-secondary text-on-secondary border-2 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]',
                        'outline' => 'bg-transparent text-on-background border-2 border-on-background',
                    ];
                    $class = $styleClasses[$style] ?? $styleClasses['primary'];
                    $textColors = ['primary' => 'var(--on-primary)', 'secondary' => 'var(--on-secondary)', 'outline' => 'var(--on-background)'];
                    $textColor = $textColors[$style] ?? 'var(--on-primary)';
                    $downloadAttr = $download ? ' download' : '';
                    $html .= '<div class="mb-6 text-center md:text-left">';
                    $html .= '<a href="' . e($url) . '" style="color:' . $textColor . ';text-decoration:none" class="inline-block px-6 py-3 font-headline-lg text-sm uppercase tracking-wider transition-all hover:scale-105 ' . $class . '" target="_blank" rel="noopener noreferrer"' . $downloadAttr . '><span class="material-symbols-outlined text-sm mr-2 align-middle">' . $icon . '</span><span class="align-middle">' . e($text) . '</span></a>';
                    $html .= '</div>';
                    break;

                case 'embed':
                    $service = $data['service'] ?? '';
                    $embed = $data['embed'] ?? '';
                    $caption = $data['caption'] ?? '';
                    if ($embed) {
                        $html .= '<div class="border-3 border-on-background brutalist-shadow mb-6 aspect-video">';
                        $html .= '<iframe class="w-full h-full" src="' . e($embed) . '" frameborder="0" allowfullscreen></iframe>';
                        if ($caption) {
                            $html .= '<div class="bg-surface-container p-3 font-label-mono text-xs uppercase border-t-3 border-on-background">' . $this->renderText($caption, false) . '</div>';
                        }
                        $html .= '</div>';
                    }
                    break;

                default:
                    if (isset($data['text'])) {
                        $html .= '<p class="font-body-md mb-6">' . $this->renderText($data['text']) . '</p>';
                    }
                    break;
            }
        }

        return $html;
    }
}