@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="card card-shadow mb-4">
            <div class="card-body">

                <h4>{{ $campaign->name }}</h4>

                <hr>

                <p>
                    <strong>Status:</strong>
                    {{ ucfirst($campaign->status) }}
                </p>

                <p>
                    <strong>Template:</strong>
                    {{ $campaign->template->name }}
                </p>

                <p>
                    <strong>Total Contacts:</strong>
                    {{ $campaign->contacts->count() }}
                </p>

            </div>
        </div>

    </div>

    <div class="col-md-8">

        <div class="card card-shadow">
            <div class="card-body">

                <h5>Email Logs</h5>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Error</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($campaign->emailLogs as $log)

                            <tr>

                                <td>
                                    {{ $log->contact->email }}
                                </td>

                                <td>
                                    {{ ucfirst($log->status) }}
                                </td>

                                <td>
                                    {{ $log->error_message }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center">
                                    No logs available.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>

</div>

@endsection