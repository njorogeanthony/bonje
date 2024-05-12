@php
    $mark = $type === 'success' ? 'check' : 'alert';
@endphp
<div class="alert alert-solid-{{ $type }} d-flex align-items-center" role="alert">
    <i class="mdi mdi-{{ $mark }}-circle-outline me-2"></i>
    {{ $message }}
</div>
