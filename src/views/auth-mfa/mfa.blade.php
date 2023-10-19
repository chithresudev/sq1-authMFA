@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('MFA Verification') }}</div>
                {{ $errors }}
                <div class="card-body">
                    <form method="POST" action="{{ route('authmfa.mfa.verification') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="totp" class="col-md-4 col-form-label text-md-end">{{ __('MFA') }}</label>

                            <div class="col-md-6">
                                <input id="totp" type="text" class="form-control @error('totp') is-invalid @enderror" name="totp" value="{{ old('mfa') }}" required autocomplete="totp" autofocus>

                                @error('totp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
