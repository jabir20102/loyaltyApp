<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        
        <div class="form-group">
            <label for="current_password">Current Password:</label>
            <input type="text" name="current_password" id="current_password" class="form-control @error('password') is-invalid @enderror"  >
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
           
        </div>
       
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  >
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  >
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
           
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</section>
