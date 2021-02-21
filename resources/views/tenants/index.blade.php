@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Tenants')}}</div>

                    <div class="card-body">
                        <a href="{{ route('tenants.create') }}" class="btn btn-sm btn-primary">Add new Tenant</a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Domain</th>
                                    <th></th>
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
                                        <td>
                                            <a href="{{ route('tenants.edit', $tenant->id) }}"
                                               class="btn btn-sm btn-success d-inline-block">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-danger d-inline-block">
                                                    Delete
                                                </button>
                                            </form>
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
    </div>

@endsection

