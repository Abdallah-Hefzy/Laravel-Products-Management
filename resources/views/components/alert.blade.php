@if (session()->has($type))
    <div class="alert alert-{{ $type }} text-center">{{ session()->get("$type") }}</div>
@endif
