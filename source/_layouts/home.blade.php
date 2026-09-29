@extends('_layouts.master')

@section('title', $page->title)

@section('head_scripts')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Person",
    "name": "{{ $page->siteAuthor }}",
    "url": "{{ $page->siteUrl }}",
    "image": "{{ $page->siteImage }}",
    "jobTitle": "Engineering Manager",
    "worksFor": { "@@type": "Organization", "name": "LeasingMarkt.de" },
    "address": { "@@type": "PostalAddress", "addressLocality": "Leipzig", "addressCountry": "DE" },
    "sameAs": [
        "https://github.com/viktoras25",
        "https://www.linkedin.com/in/vkts",
        "https://t.me/viktoras"
    ]
}
</script>
@endsection

@section('head_styles')
<style>
    body, html {
        height: 100%;
        width: 100%;
        padding: 0 !important;
    }

    body {
        background-image: url('/img/viktoras_6.jpg');
        background-position: -40vh 50px;
        background-repeat: no-repeat;
        background-size: auto min(100vh, 100vw);
    }

    .container-fluid {
        height: 100%;
    }

    .container-fluid .row {
        height: 100%;
    }

    section#description {
        height: calc(100% - 60px - 16px);
        display: flex;
        flex-direction: column;
    }

    @media (orientation: portrait) {
        section#description {
            padding: 0 1em;
        }
    }

    section#description div#main-text {
        margin-top: 25vh;
        flex-grow: 2;
        text-align: center;
    }

    section#description footer {
        flex-basis: 20px;
    }

    section#description ul {
        list-style: none;
    }

    @media (max-width: 767px) {
        body {
            background-position: -70px 80px;
            background-size: min(100%, 600px) auto;
        }

        section#photo-spacer {
            min-height: min(100vw, 600px);
            margin-top: 40px;
        }

        section#description {
            height: auto;
        }

        section#description div#main-text {
            margin-top: 0;
        }
    }

    div.social-icons {
        font-size: 1.5em;
    }

    div.social-icons i {
        margin: 0 5px;
    }

    div.social-icons i.bi-at {
        position: relative;
        display: inline-block;
        width: 1em;
        height: 1em;
        border: 2px solid currentColor;
        border-radius: 50%;
        vertical-align: -0.125em;
    }

    div.social-icons i.bi-at::before {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.7em;
        -webkit-text-stroke: 0.035em currentColor;
    }

    .navbar a {
        text-decoration: none !important;
    }

    .nav-link {
        line-height: 60px;
        padding: 0 10px !important;
        font-size: 15px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.035rem;
        margin-left: 10px;
    }
</style>
@endsection

@section('contents')
    <div class="container-fluid g-0">
        <div class="row g-0">

            <nav class="navbar navbar-expand offset-lg-5 offset-md-4 col-lg-7 col-md-8 col-sm-12" style="top: 0; left: 0; right: 0;">
                <div class="collapse navbar-collapse justify-content-center">
                    @include('_partials.menu-items')
                </div>
            </nav>

            <section class="col-md-5" id="photo-spacer"></section>

            <section class="col-md-7" id="description">
                <div id="main-text">
                    <div>
                        <h1>Viktoras Bezaras</h1>

                        <h5>Engineering Manager at LeasingMarkt.de</h5>
@php
    $nowMonths = (int) date('Y') * 12 + (int) date('n');
    $stats = [
        ['year' => 2008, 'month' => 7, 'round' => 'down', 'label' => 'of software development'],
        ['year' => 2019, 'month' => 7, 'round' => 'down', 'label' => 'of engineering management'],
        ['year' => 2025, 'month' => 8, 'round' => 'up', 'label' => 'of AI development'],
    ];
@endphp
<ul>
    @foreach ($stats as $s)
        @php
            $months = $nowMonths - ($s['year'] * 12 + $s['month']);
            $years = $s['round'] === 'up' ? intdiv($months + 11, 12) : intdiv($months, 12);
        @endphp
        <li><span class="js-years" data-year="{{ $s['year'] }}" data-month="{{ $s['month'] }}" data-round="{{ $s['round'] }}">{{ $years }} {{ $years == 1 ? 'year' : 'years' }}</span> {{ $s['label'] }}</li>
    @endforeach
</ul>

                        <div class="social-icons">
                            <a href="https://github.com/viktoras25" title="GitHub"><i class="bi-github"></i></a>
                            <a href="https://www.linkedin.com/in/vkts" title="LinkedIn"><i class="bi-linkedin"></i></a>
                            <a href="https://t.me/viktoras" title="Telegram"><i class="bi-telegram"></i></a>
                            <a href="#" class="js-mail" data-user="viktoras.bezaras" data-domain="gmail.com" title="Email"><i class="bi-at"></i></a>
                            <a href="/cv" title="CV"><i class="bi-person-circle"></i></a>
                        </div>
                        <script>
                            document.querySelectorAll('.js-mail').forEach(function (a) {
                                a.href = 'mailto:' + a.dataset.user + '@' + a.dataset.domain;
                            });

                            var now = new Date(), nowMonths = now.getFullYear() * 12 + now.getMonth() + 1;
                            document.querySelectorAll('.js-years').forEach(function (el) {
                                var months = nowMonths - (el.dataset.year * 12 + +el.dataset.month);
                                var years = el.dataset.round === 'up' ? Math.ceil(months / 12) : Math.floor(months / 12);
                                el.textContent = years + (years === 1 ? ' year' : ' years');
                            });
                        </script>
                    </div>
                </div>

                @include('_partials.footer')
            </section>
        </div>
    </div>
@endsection
