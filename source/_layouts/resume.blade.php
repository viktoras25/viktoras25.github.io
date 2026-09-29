@extends('_layouts.master')

@section('head_styles')
    <style>
        @media print {
            body {
                font-size: 0.8em !important;
            }

            h5 {
                font-size: 1.2em !important;
            }
        }

        body {
            padding: 0 !important;
            font-size: 16px;
        }
    </style>
@endsection
