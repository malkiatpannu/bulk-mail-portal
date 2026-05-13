@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Campaigns</h3>

    <a href="{{ route('campaigns.create') }}"
       class="btn btn-primary">
        Create Campaign
    </a>
</div>

<div class="card card-shadow">
    <div class="card-body table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Template</th>
                    <th>Status</th>
                    <th>Scheduled</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($campaigns as $campaign)

                    <tr>

                        <td>{{ $campaign->name }}</td>

                        <td>{{ $campaign->template->name }}</td>

                        <td>
                            <span class="badge bg-dark">
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $campaign->scheduled_at?->format('d M Y h:i A') }}
                        </td>

                        <td>

                            <a href="{{ route('campaigns.show', $campaign) }}"
                               class="btn btn-sm btn-info">
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No campaigns found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $campaigns->links() }}

    </div>
</div>

@endsection