<x-guest-layout>
    <!-- Session Status -->
    <div class="container-fluid login-screen">
        <div class="row">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="col-md-6">
                <div
                    class="d-flex flex-column mx-auto justify-content-center col-md-8"
                    style="height: 100%"
                >
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="d-flex justify-content-center align-items-left flex-column mx-5"
                    >
                        @csrf

                        <!-- Email Address -->
                        <x-login-logo />

                        <div class="mt-5">
                            <h2>Welcome Back</h2>

                            <div>
                                <input
                                    id="email"
                                    type="string"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Login"
                                    class="w-100"
                                />
                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password"
                                    class="w-100"
                                />

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-primary">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label
                                    for="remember_me"
                                    class="inline-flex items-center"
                                >
                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="remember"
                                    />
                                    <span
                                        class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        {{ __('Remember me') }}
                                    </span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a
                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                        href="{{ route('password.request') }}"
                                    >
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Your image -->

            <div class="col-md-6 px-0">
                <!-- Content for the other half of the layout -->

                <img src="../../images/login-image.png" class="img-fluid" />
            </div>
        </div>
    </div>
</x-guest-layout>
