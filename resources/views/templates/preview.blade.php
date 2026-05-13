@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Template Preview
        </h3>

        <div class="mb-4">

            <h5>Subject</h5>

            <div class="border rounded p-3 bg-light">
                {{ $subject }}
            </div>

        </div>

        <div>

            <h5>Email Body</h5>

            <div class="border rounded p-4">
                {!! $body !!}
            </div>

        </div>

    </div>
</div>

@endsection