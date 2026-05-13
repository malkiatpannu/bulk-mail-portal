@extends('layouts.app')

@section('content')

<div class="card card-shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Create Campaign
        </h3>

        <form action="{{ route('campaigns.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Campaign Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Select Template</label>

                <select name="template_id"
                        class="form-control"
                        required>

                    <option value="">
                        Select Template
                    </option>

                    @foreach($templates as $template)

                        <option value="{{ $template->id }}">
                            {{ $template->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Select Contacts</label>

                <select name="contacts[]"
                        class="form-control"
                        multiple
                        size="10"
                        required>

                    @foreach($contacts as $contact)

                        <option value="{{ $contact->id }}">
                            {{ $contact->name }}
                            ({{ $contact->email }})
                        </option>

                    @endforeach

                </select>

                <small class="text-muted">
                    Hold CTRL to select multiple contacts.
                </small>

            </div>

            <div class="mb-4">

                <label>
                    Schedule Time (Optional)
                </label>

                <input type="datetime-local"
                       name="scheduled_at"
                       class="form-control">

            </div>

            <button class="btn btn-primary">
                Create Campaign
            </button>

        </form>

    </div>
</div>

@endsection