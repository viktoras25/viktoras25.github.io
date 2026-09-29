@extends('_layouts.master')

@section('contents')
    <div class="container">
        <div class="row g-0">
            <nav class="navbar navbar-expand col-12" style="top: 0; left: 0; right: 0;">
                <div class="collapse navbar-collapse justify-content-center">
                    @include('_partials.menu-items')
                </div>
            </nav>
        </div>

        @unless ($page->legal_page)
        <div id="header" class="text-center">
            <div id="invader-wrapper">
                <a href="/"></a>
            </div>
        </div>
        @endunless

        <div class="row justify-content-center">
            <main class="col-9">
                @yield('posts')
            </main>
        </div>

        @include('_partials.footer')
    </div>
@endsection
