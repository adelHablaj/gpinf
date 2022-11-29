@extends('layouts.login')
@section('pageTitle', config('app.name') . ' - ' . __('Login'))
@section('content')
    <!-- BEGIN LOGIN SECTION -->
    <section class="section-account">
        <div class="img-backdrop" style="background-image: url('{{ asset('images/bg-login.jpg') }}')"></div>
        <div class="spacer"></div>
        <div class="card contain-sm style-transparent">
            <div class="card-body">
                <div class="row">
                    <div class="contain-sm width-8">
                        <br />
                        <span class="text-lg text-bold text-primary">{{ config('app.name') }}</span>
                        <br /><br />

                        <form class="form form-validate floating-label" action="{{ route('login') }}" accept-charset="utf-8"
                            method="post">
                            @csrf
                            <div class="form-group @error('email') has-error @enderror">
                                <input id="email" type="email" class="form-control"
                                    @error('email') aria-describedby="Email-error" aria-required="true" @enderror
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="email">{{ __('E-mail') }}</label>
                                @error('email')
                                    <span id="email-error" class="helper-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('password') has-error @enderror">
                                <input id="password" type="password" class="form-control"
                                    @error('password') aria-describedby="password-error" aria-required="true" @enderror
                                    name="password" value="{{ old('password') }}" required autocomplete="password"
                                    autofocus>
                                <label for="password">{{ __('Password') }}</label>
                                @error('password')
                                    <span id="password-error" class="helper-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <button class="btn btn-primary btn-raised" type="submit">{{ __('Login') }}</button>
                                </div>
                                <!--end .col -->
                            </div>
                            <!--end .row -->
                        </form>
                    </div>
                    <!--end .col -->
                </div>
                <!--end .row -->
            </div>
            <!--end .card-body -->
        </div>
        <!--end .card -->
    </section>
    <!-- END LOGIN SECTION -->
    @push('jqvalidation-js')
        <script src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    @endpush
@endsection
