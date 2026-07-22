@php
    $seoTitle = $title ?? config('app.name');
    $seoDescription = $description ?? 'Portal berita dan informasi resmi SMK Merdeka Bandung.';
    $seoImage = $image ?? url('smk-merdeka-logo.png');
    $seoType = $type ?? 'website';
    $seoUrl = $url ?? url()->current();
    $seoSiteName = config('app.name');
@endphp

<meta name="title" content="{{ $seoTitle }}">
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $seoUrl }}">

<meta property="og:type" content="{{ $seoType }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:site_name" content="{{ $seoSiteName }}">
<meta property="og:locale" content="id_ID">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">

@if($seoType === 'article' && isset($publishedTime))
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if($seoType === 'article' && isset($author))
<meta property="article:author" content="{{ $author }}">
@endif

@if($seoType === 'article' && isset($section))
<meta property="article:section" content="{{ $section }}">
@endif
