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
                            <th scope="col">>{{ __('Generation of game') }}</th>
                        </tr>
                        @foreach($characters as $character)
                            <tr>
                                <td>{{ $character->name }}</td>
                                <td>{{ $character->generation }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
