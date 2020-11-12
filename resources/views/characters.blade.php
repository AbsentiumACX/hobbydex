@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Characters') }}</div>

                <div class="card-body">
                    <?php print_r($characters); ?>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
