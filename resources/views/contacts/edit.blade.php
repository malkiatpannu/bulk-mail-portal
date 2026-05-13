@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Edit Contact
        </h3>

        <form action="{{ route('contacts.update', $contact) }}"
              method="POST">

            @csrf
            @method('PUT')

            @include('contacts.partials.form')

        </form>

    </div>
</div>

@endsection