@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('global.create') }}</div>

                    <div class="card-body">
                        <form action="/categories" method="post">
                            @csrf
                            <input type="text" name="name">
                            <button type="submit">{{ __('global.create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection