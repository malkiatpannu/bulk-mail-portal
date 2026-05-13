@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Create Template
        </h3>

        <form action="{{ route('templates.store') }}"
              method="POST">

            @csrf

            @include('templates.partials.form')

        </form>

    </div>
</div>

@endsection