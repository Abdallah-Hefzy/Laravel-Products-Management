 <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
     {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>

 @error($name)
     <div class="invlid-feedback text-danger">
         {{ $message }}
     </div>
 @enderror
