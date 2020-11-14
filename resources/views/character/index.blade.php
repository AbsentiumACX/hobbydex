@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-left">
                                <h2>{{ __('Characters') }}</h2>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('character.create') }}" title="Create a project">
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-striped" width="100%">
                        <tr>
                            <th scope="col">{{ __('Character name') }}</th>
                            <th scope="col">{{ __('Generation of game') }}</th>
                            <th scope="col"></th>
                        </tr>
                        @foreach($characters as $character)
                            <tr>
                                <td>{{ $character->name }}</td>
                                <td>{{ $character->generation }}</td>
                                <td>
                                    <form action="{{ route('character.destroy', $character->id) }}" method="POST">
                                        <a href="{{ route('character.show', $character->id) }}" title="show">
                                            <i class="fas fa-eye text-success  fa-lg"></i>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                            <i class="fas fa-trash fa-lg text-danger"></i>

                                        </button>
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
