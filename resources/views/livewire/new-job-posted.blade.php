<div x-data="{ show: false }"
     x-init="@this.on('popup-triggered', () => show = true)"
     class="relative">

    <!-- Simple alert -->
    <div x-show="show"
         x-transition
         class="absolute top-0 left-0 bg-white border border-gray-300 p-6 rounded shadow-lg w-64">

        <p class="mb-4 text-center font-semibold">🎉 New Job Posted!</p>

        <script>
            // Auto hide the alert after 3 seconds
            setTimeout(() => {
                document.querySelector('[x-data]').__x.$data.show = false;
            }, 3000);
        </script>
    </div>
</div>
