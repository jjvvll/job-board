
{{-- <div
    x-data="{ open: @entangle('show').defer }"
    x-show="open"
    x-transition
    class="fixed bottom-5 right-5 bg-gray-800 text-white p-4 rounded-lg shadow-lg w-80"
>
    <div class="font-bold text-lg">{{ $title }}</div>
    <div>{{ $body }}</div>
</div> --}}

{{--
<div>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500
      });
</div>

<script>
    window.addEventListener('hide-popup', event => {
        setTimeout(() => {
            Livewire.dispatch('hidePopup');
        }, event.detail.delay);
    });
</script> --}}
<div></div>
<script>
document.addEventListener('livewire:initialized', () => {
    Livewire.on('showSweetAlert', (params) => {
        // Extract the first (and only) item from the array
        const alertData = params[0];

        Swal.fire({
            position: "top-end",
            icon: alertData.icon || 'info',
            title: alertData.title,
            text: alertData.text,
            showConfirmButton: false,
            timer: 1500
        });
    });
});
    </script>

