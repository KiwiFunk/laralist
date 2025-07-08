@extends('layouts.app')

@section('title', 'Your Projects | LaraList')

@section('navbar')
    <x-navbar />
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12 pt-40">

        <!-- Header Section -->
        @include('partials.header')

        <!-- Project Cards -->
        @if($projects->count() > 0)
            <div class="grid gap-6">
                @foreach($projects as $index => $project)
                    <x-project-card :project="$project" :index="$index" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            @include('partials.empty-projects')
        @endif
    </div>
@endsection