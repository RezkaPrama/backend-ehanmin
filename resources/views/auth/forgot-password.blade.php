@extends('layouts.master-without_nav')

@section('title') Reset Password @endsection

@section('content')

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="text-center mb-4">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span
                            class="logo-txt">E-Minkatmil</span>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Reset Password</h5>
                                <p class="text-muted">Reset Password E-Minkatmil.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <div class="alert alert-success text-center small mb-4" role="alert">
                                    Masukkan Email Anda dan instruksi akan dikirimkan kepada Anda!
                                </div>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="useremail">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Masukkan Alamat Email">
                                        @error('email')
                                        <div class="alert alert-danger mt-2">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light"
                                            type="submit">Reset</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Remember It ? <a href="{{ url('/login') }}"
                                                class="fw-medium text-primary"> Sign in </a></p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-muted p-4">
                        <p class="text-white-50">© <script>
                                document.write(new Date().getFullYear())
                            </script> E-Minkatmil</p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div>

@endsection