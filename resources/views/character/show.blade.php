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
                                <h2>  {{ $character->name }}</h2>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('character.index') }}" title="Go back">
                                    <i class="fas fa-backward "></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $character->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Playing generation:</strong>
                                Generation {{ $character->generation }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Date Created:</strong>
                                {{ date_format($character->created_at, 'jS M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"><br></div>
            @include('pokedex.show')
        </div>
    </div>
</div>
@endsection
