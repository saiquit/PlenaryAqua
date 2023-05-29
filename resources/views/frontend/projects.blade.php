@extends('layouts.frontend.base')
@section('title')
    Projects
@endsection

@section('main')
    <div class="container py-4 my-4">
        @foreach ($projects as $project)
            <div class="row featurette @if ($loop->index % 2 == 0) flex-row-reverse @endif">
                <div class="col-md-7">
                    <h2 class="featurette-heading">{{ $project['name_' . app()->getLocale()] }}</span>
                    </h2>
                    <p class="lead">{!! $project['desc_' . app()->getLocale()] !!}</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" style="width: 500px; height: 500px;"
                        src="{{ url('storage/' . $project->featured_img) }}" data-holder-rendered="true">
                </div>
            </div>
            <hr class="featurette-divider">
        @endforeach
    </div>
@endsection

@push('css')
    <style>
        .featurette-divider {
            margin: 5rem 0;
        }
    </style>
@endpush
