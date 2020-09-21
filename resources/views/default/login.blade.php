@extends('ray::'. $template .'.layouts.app')

@push("title") Страница авторизации @endpush

@section("content")
    <div class="d-flex align-items-center" style="height: 100vh">
        <form class="form-signin" method="post" action="{{ route( config('ray.routes.root-name') . '.postLogin' ) }}">
            {!! csrf_token() !!}
            <pre>PP: {{ print_r( app('session')  )  }}</pre>
            {!! csrf_field() . method_field('post') !!}
            <div class="text-center mb-4">
                @if( config('ray.admin.login-logo') )
                <img class="mb-4" src="{{ config('ray.admin.login-logo') }}" alt="" width="128">
                @endif
                <h1 class="h3 mb-3 font-weight-normal">Ray Admin</h1>
                <p>
                    {{ trans('ray::login.Input your login & password') }}
                </p>
            </div>

            <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="{{ trans('ray::login.E-mail') }}" required="" autofocus="">
                <label for="inputEmail">{{ trans('ray::login.E-mail') }}</label>
            </div>

            <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="{{ trans('ray::login.Password') }}" required="">
                <label for="inputPassword">{{ trans('ray::login.Password') }}</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember-me" value="remember-me"> {{ trans('ray::login.Remember me') }}
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                {{ trans('ray::login.Sing in') }}
            </button>
        </form>
    </div>
@endsection

@push('footer')
    <style>
        .form-signin {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: auto;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input,
        .form-label-group label {
            height: 3.125rem;
            padding: .75rem;
        }

        .form-label-group label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0; /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            pointer-events: none;
            cursor: text; /* Match the input under the label */
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:-moz-placeholder-shown) {
            padding-top: 1.25rem;
            padding-bottom: .25rem;
        }

        .form-label-group input:not(:-ms-input-placeholder) {
            padding-top: 1.25rem;
            padding-bottom: .25rem;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: 1.25rem;
            padding-bottom: .25rem;
        }

        .form-label-group input:not(:-moz-placeholder-shown) ~ label {
            padding-top: .25rem;
            padding-bottom: .25rem;
            font-size: 12px;
            color: #777;
        }

        .form-label-group input:not(:-ms-input-placeholder) ~ label {
            padding-top: .25rem;
            padding-bottom: .25rem;
            font-size: 12px;
            color: #777;
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: .25rem;
            padding-bottom: .25rem;
            font-size: 12px;
            color: #777;
        }

        /* Fallback for Edge
        -------------------------------------------------- */
        @supports (-ms-ime-align: auto) {
            .form-label-group {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column-reverse;
                flex-direction: column-reverse;
            }

            .form-label-group label {
                position: static;
            }

            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

    </style>
@endpush
