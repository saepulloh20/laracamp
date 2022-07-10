@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register data</th>
                                    <th>Paid Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($checkouts as $checkout)
                                    <tr>
                                        <td>{{ $checkout->user->name }}</td>
                                        <td>{{ $checkout->Camp->title }}</td>
                                        <td>{{ $checkout->Camp->price }}</td>
                                        <td>{{ $checkout->created_at->format('M d y') }}</td>
                                        <td>
                                            @if ($checkout->payment_status)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Waiting</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No Camp Registered</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
