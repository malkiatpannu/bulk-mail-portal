@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Edit Template
        </h3>

        <form action="{{ route('templates.update', $template) }}"
              method="POST">

            @csrf
            @method('PUT')

            @include('templates.partials.form')

        </form>

    </div>
</div>

@endsection