<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Bearer token') }}
        </h2>
    </header>

    <x-text-input type="text" class="mt-1 block w-full" :value="$user->bearer_token" required autofocus/>

</section>
