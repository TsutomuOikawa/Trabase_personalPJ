@vite(['resources/ts/parts/modal.ts'])
<div class="modal ts-modal">
    <div class="modal_content">
        <p class="modal_header">{{ $modal_title }}</p>
        {{ $modal_content }}
        <p class="modal_action ts-hide-modal">{{ $modal_action }}</p>
    </div>
    <div class="modal_cover"></div>
</div>
