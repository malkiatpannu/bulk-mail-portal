@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Email Templates</h3>

    <a href="{{ route('templates.create') }}"
       class="btn btn-primary">
        Create Template
    </a>
</div>

<div class="card card-shadow mb-4">
    <div class="card-body">

        <form method="GET" class="row g-3">

            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search templates..."
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

<div class="card card-shadow">
    <div class="card-body table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th width="250">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($templates as $template)

                    <tr>

                        <td>{{ $template->name }}</td>

                        <td>{{ $template->subject }}</td>

                        <td>

                            <a href="{{ route('templates.preview', $template) }}"
                               class="btn btn-sm btn-info">
                                Preview
                            </a>

                            <a href="{{ route('templates.edit', $template) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('templates.destroy', $template) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete template?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center">
                            No templates found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $templates->links() }}

    </div>
</div>

@endsection