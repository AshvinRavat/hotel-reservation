<x-guest-layout>
    <x-auth-card>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden"
                   name="token"
                   value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email"
                       class="form-label">Email address <span class="text-danger">*</span></label>
                <input id="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email',$request->email) }}"
                       autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           autocomplete="current-password">
                    <a href="javascript:;" class="input-group-text bg-transparent" id="eye">
                        <i class="fa-solid fa-eye"></i></a>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input id="password_confirmation" type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation">
                    <a href="javascript:;" class="input-group-text bg-transparent" id="password_confirmation_eye">
                        <i class="fa-solid fa-eye"></i></a>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                        class="btn btn-primary btn-login w-100">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
