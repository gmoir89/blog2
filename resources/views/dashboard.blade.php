@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Check if there is a success message in the session -->
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h1 class="text-2xl font-semibold mb-4 text-center">{{ __('User Information') }}</h1>

                    <div class="mb-4">
                        <strong>{{ __('Username') }}:</strong> {{ auth()->user()->name }}
                    </div>

                    <div class="mb-4">
                        <strong>{{ __('Email Address') }}:</strong> {{ auth()->user()->email }}
                    </div>

                    <div class="mb-4">
                        <strong>{{ __('Date of Registration') }}:</strong> {{ auth()->user()->created_at->format('F j, Y \a\t h:i A') }}
                    </div>

                    <form class="bg-white p-4 rounded shadow-md" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h2 class="text-2xl font-semibold mb-4 text-center">{{ __('Change Password') }}</h2>

                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">{{ __('Change Password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection