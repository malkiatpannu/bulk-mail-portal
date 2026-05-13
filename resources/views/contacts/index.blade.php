@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Contacts</h3>

    <a href="{{ route('contacts.create') }}"
       class="btn btn-primary">
        Add Contact
    </a>
</div>

<div class="card card-shadow mb-4">
    <div class="card-body">

        <form method="GET"
              class="row g-3">

            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search contacts..."
                       value="{{ $search }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-dark w-100">
                    Search
                </button>
            </div>

        </form>

    </div>
</div>

<div class="card card-shadow mb-4">
    <div class="card-body">

        <form action="{{ route('contacts.import') }}"
              method="POST"
              enctype="multipart/form-data"
              class="row g-3">

            @csrf

            <div class="col-md-4">
                <input type="file"
                       name="file"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">
                    Import CSV
                </button>
            </div>

        </form>

    </div>
</div>

<div class="card card-shadow">
    <div class="card-body table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Custom Fields</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($contacts as $contact)

                    <tr>

                        <td>{{ $contact->name }}</td>

                        <td>{{ $contact->email }}</td>

                        <td>{{ $contact->phone }}</td>

                        <td>

                            @if($contact->custom_fields)

                                @foreach($contact->custom_fields as $key => $value)

                                    <div>
                                        <strong>
                                            {{ ucfirst($key) }}:
                                        </strong>

                                        {{ $value }}
                                    </div>

                                @endforeach

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('contacts.edit', $contact) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('contacts.destroy', $contact) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete contact?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No contacts found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $contacts->links() }}

    </div>
</div>

@endsection