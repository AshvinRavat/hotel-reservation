<x-guest-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="first_name" class="form-label">
                    First Name
                    <span class="text-danger">*</span></label>
                <input id="first_name"
                       type="text"
                       class="form-control @error('first_name') is-invalid @enderror"
                       name="first_name"
                       value="{{ old('first_name') }}">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">
                    Last Name
                    <span class="text-danger">*</span>
                </label>
                <input id="last_name"
                       type="text"
                       class="form-control @error('last_name') is-invalid @enderror"
                       name="last_name"
                       value="{{ old('last_name') }}">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email address
                    <span class="text-danger">*</span>
                </label>
                <input id="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Password
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <input id="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input id="password_confirmation"
                        type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label>
                    <input type="checkbox"
                        class="@error('accept_condition') is-invalid @enderror"
                        name="accept_condition"
                       @if(old('accept_condition')) checked @endif >
                    <span>
                        I have read and accept the Terms & Condations
                    </span>
                </label>
                @error('accept_condition')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button type="submit" class="btn btn-primary btn-login">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
