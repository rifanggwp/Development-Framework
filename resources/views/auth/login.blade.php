@extends('layouts.auth')

@section('content')
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('img/logoyolalandscape.png') }}" alt="logo" width="150">
            </div>

            <div class="card card-primary">
                @if ($errors->any())
                    <div class="alert alert-danger border-left-danger" role="alert">
                            Periksa Kembali NIP dan Password Anda
                    </div>
                @endif
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                  @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="invalid-feedback">
                            Silahkan isi email Anda
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                            <div class="float-right">
                                <a href="#" class="text-primary text-small toggle-password" toggle="#password">
                                    <b>Tampilkan Password</b>
                                </a>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="invalid-feedback">
                            Silahkan isi password Anda
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                        Login
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.querySelector('#password');
        const togglePasswordButton = document.querySelector('.toggle-password');

        togglePasswordButton.addEventListener('click', function () {
            const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', passwordType);

            // Update the button text
            const buttonText = passwordType === 'password' ? 'Tampilkan Password' : 'Sembunyikan Password';
            togglePasswordButton.innerHTML = `<b>${buttonText}</b>`;
        });
    });
</script>
@endsection
