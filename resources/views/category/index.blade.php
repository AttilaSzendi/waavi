@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('category.categoryName') }}</div>
                    {{--<div class="card-header">lófasz</div>--}}

                    <div class="card-body">
                        <ul>
                            @foreach($categories as $category)
                                    <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        <a href="/categories/create">{{ __('global.create') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection