@php
    $type = isset($type) && in_array($type, ['text','number','hidden','email','date','file'], $type) ? $type : 'text';
    $value = old($name, $value ?? '');
    $placeholder = $placeholder ?? '';
    $colLeft = $colLeft ?? 4;
    $class = $class ?? 'form-control';
@endphp
<div class="row">
    <div class="col-12 col-lg-{{$colLeft}} mb-3">
        <label for="input{{$name}}">{{$label}}</label>
        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
        <input type="{{$type}}" class="{{$class}} @if($errors->has($name)) is-invalid @endif" id="input{{ucfirst($name)}}"
               name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}">
        @if($errors->has($name))
            <div class="invalid-feedback">
                {{$errors->first($name)}}
            </div>
        @endif
    </div>
</div>
