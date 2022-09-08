<!-- 'template.' is the directory in 'dot notation' -->
@extends('template.outer_layout')

@section('contents')

<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">

    <h1>This is modified welcome blade</h1>

@if (isset($totalSum))
    <h3 style="color: red;">Total is: {{ $totalSum }}</h1>
@else
    <h3 style="color: red;">No Total Sum Given</h1>
@endif

</div>

@endsection