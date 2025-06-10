@extends('layouts.app')

@section('title', 'Your Tasks | LaraList')

@push('head')
    <!-- Store task data in a meta tag for easy access in JavaScript -->
    <meta name="tasks-data" content="{{ json_encode($tasks) }}">
@endpush

@section('navbar')
    <x-navbar />
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12 pt-10 md:pt-40">

        <!-- Header Section -->
        @include('partials.header')

        <!-- Stats Bar -->
        <x-stats-bar />

        <!-- Create Task Bar -->
        <x-create-task-form />

        <!-- Task Cards -->
        @if($tasks->count() > 0)
            <div class="grid gap-6">
                @foreach($tasks as $index => $task)
                    <x-task-card :task="$task" :index="$index" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            @include('partials.empty-tasks')
        @endif
    </div>
@endsection