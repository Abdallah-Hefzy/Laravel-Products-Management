  <select name="{{ $name }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
      @foreach ($options as $vlaue => $label)
          <option value="{{ $vlaue }}" @selected(old($name, $selected) == $vlaue)>
              {{ $label }}</option>
      @endforeach
  </select>
  @error($name)
      <div class="invalid-feedback text-danger">
          {{ $message }}
      </div>
  @enderror
  

