@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Create Contact
        </h3>

        <form action="{{ route('contacts.store') }}"
              method="POST">

            @csrf

            @include('contacts.partials.form')

        </form>

    </div>
</div>

@endsection