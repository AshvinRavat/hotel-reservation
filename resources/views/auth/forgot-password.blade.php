<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-4">
                <div class="mb-3">
                    <label for="email"
                           class="form-label">Email address <span class="text-danger">*</span></label>
                    <input id="email"
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="btn btn-primary btn-login w-100">{{ __('Email Password Reset Link') }}</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
