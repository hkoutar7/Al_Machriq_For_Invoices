<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('هذه منطقة آمنة في التطبيق. يُرجى تأكيد كلمة المرور قبل الاستمرار.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- كلمة المرور -->
        <div>
            <x-input-label for="password" :value="__('كلمة المرور')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('تأكيد') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
