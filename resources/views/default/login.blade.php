@extends( $template . 'layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-3 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('ray.post-login') }}" method="post">
                            @csrf @method('post')
                            <div class="form-group">
                                <label for="login-fl">
                                    Login
                                </label>
                                <input id="login-fl" type="text" name="login">
                            </div>
                            <div class="form-group">
                                <label for="password-fl">
                                    Password
                                </label>
                                <input id="password-fl" type="text" name="password">
                            </div>
                            <div>
                                <button type="submit">
                                    OK
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
