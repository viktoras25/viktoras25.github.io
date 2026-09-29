<!DOCTYPE html>
<html lang="{{ $page->lang ?? 'en' }}">
    <head>
        <title>@yield('title', $page->title . ' - ' . $page->siteName)</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        @section('head_meta')
            @php
                $pageUrl = $page->siteUrl . rtrim($page->getPath(), '/') . '/';
                $description = $page->description ?? $page->siteDescription;
            @endphp
            <meta name="robots" content="@yield('robots', 'index, follow')">
            <meta name="description" content="{{ $description }}">
            <link rel="canonical" href="{{ $pageUrl }}">

            <meta property="og:type" content="{{ $page->og_type ?? 'website' }}">
            <meta property="og:url" content="{{ $pageUrl }}">
            <meta property="og:title" content="{{ trim($__env->yieldContent('title', $page->title . ' - ' . $page->siteName)) }}">
            <meta property="og:description" content="{{ $description }}">
            <meta property="og:image" content="{{ $page->siteImage }}">
        @show

        <link href="/css/app.css" rel="stylesheet" type="text/css" />
        <script src="/js/app.js"></script>

        @yield('head_styles')
        @yield('head_scripts')
    </head>

    <body>
        @yield('contents')
    </body>
</html>
