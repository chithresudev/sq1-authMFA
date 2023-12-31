@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Message') }}</div>
                <div class="card-body">
                   {{ $message ?? NULL  }}
                </div>
                <a href="{{ route('authmfa.login') }}" class="btn bg-info btn-sm">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
