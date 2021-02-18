<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full max-w-screen-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div>
            {{ $logo }}
            <hr class="mb-4">
        </div>
        {{ $slot }}
    </div>
</div>
