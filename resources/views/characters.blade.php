@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Characters') }}</div>

                <div class="card-body">
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
                                    @method('DELETE')

                                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                        <svg class="bi" width="32" height="32" fill="currentColor">
                                            <use xlink:href="bootstrap-icons.svg#trash"/>
                                        </svg>

                                    </button>
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
