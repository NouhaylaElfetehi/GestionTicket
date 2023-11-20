@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                            <table class="table thead-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">FirstName</th>
                                    <th scope="col">LastName</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(', ',$user->Roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit' , $user->id ) }}"> <button type="button" class="btn btn-primary float-left">Edit</button> </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
