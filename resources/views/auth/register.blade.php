<x-guest-layout>

    <!-- Back to Home Button -->
    <div class="mb-4">
        <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-dark uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ __('Back to Home') }}
        </a>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Location (Hide for Admin) -->
        <div class="mt-4" id="location-field">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Age (for Member and Volunteer roles) -->
        <div class="mt-4" id="age-field" style="display: none;">
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        <!-- Disability (Optional for Members) -->
        <div class="mt-4" id="disability-field" style="display: none;">
            <x-input-label for="disability" :value="__('Disability (Optional)')" />
            <x-text-input id="disability" class="block mt-1 w-full" type="text" name="disability" :value="old('disability')" />
            <x-input-error :messages="$errors->get('disability')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="member" selected>Member</option>
                <option value="caregiver">Caregiver</option>
                <option value="volunteer">Volunteer</option>
                <option value="partner">Partner</option>
                <option value="admin">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    // Function to update the form fields based on role
    function updateFormFields(role) {
        var ageField = document.getElementById('age-field');
        var disabilityField = document.getElementById('disability-field');
        var locationField = document.getElementById('location-field');

        // Default visibility
        ageField.style.display = 'none';
        disabilityField.style.display = 'none';
        locationField.style.display = 'block';

        if (role === 'member') {
            ageField.style.display = 'block';
            disabilityField.style.display = 'block'; // Members need the disability field
        } else if (role === 'volunteer') {
            ageField.style.display = 'block';
        } else if (role === 'admin') {
            locationField.style.display = 'none'; // Admins do not need location
        }
    }

    // Initialize form fields on page load
    document.addEventListener('DOMContentLoaded', function () {
        var role = document.getElementById('role').value;
        updateFormFields(role);
    });

    // Update form fields when role changes
    document.getElementById('role').addEventListener('change', function () {
        updateFormFields(this.value);
    });
</script>
