@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3 mb-4">

        <div class="card card-shadow">
            <div class="card-body">

                <h6>Total Contacts</h6>

                <h2>
                    {{ \App\Models\Contact::count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-shadow">
            <div class="card-body">

                <h6>Total Templates</h6>

                <h2>
                    {{ \App\Models\Template::count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-shadow">
            <div class="card-body">

                <h6>Total Campaigns</h6>

                <h2>
                    {{ \App\Models\Campaign::count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-shadow">
            <div class="card-body">

                <h6>Total Emails Sent</h6>

                <h2>
                    {{ \App\Models\EmailLog::where('status', 'sent')->count() }}
                </h2>

            </div>
        </div>

    </div>

</div>

@endsection