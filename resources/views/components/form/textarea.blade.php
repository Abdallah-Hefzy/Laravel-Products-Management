<textarea name="{{ $name }}" cols="{{ $cols }}" rows="{{ $rows }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
    >{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid-feedback text-danger">
        {{ $message }}
    </div>
@enderror
