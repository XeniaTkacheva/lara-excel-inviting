@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Tenants')}}</div>

                    <div class="card-body">
                        <a href="{{ route('tenants.create') }}" class="btn btn-sm btn-primary">Add new Tenant</a>
                        <br />
                        <br />
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Domain</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tenants as $tenant)
                                <tr>
                                    <td>
                                        {{ $tenant->firstname }}
                                        @if($tenant->lastname)
                                            {{ $tenant->lastname }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $tenant->email }}
                                    </td>
                                    <td>
                                        {{ $tenant->domain }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No tenants.</td>
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

