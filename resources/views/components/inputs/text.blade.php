@php
    $inputTypes = ['text','number','hidden','email','date','file', 'password'];
    $type = isset($type) && in_array($type, $inputTypes) ? $type : 'text';
    $value = old($name, $value ?? '');
    $placeholder = $placeholder ?? '';
    $colLeft = $colLeft ?? 4;
    $class = $class ?? 'form-control';
    $rowClass = $rowClass ?? '';
    $disabled = $disabled ?? '';
    $disabled = $disabled == true ? 'disabled' : '';
    $inputData = $inputData ?? [];
@endphp
<div class="row {{$rowClass}}">
    <div class="col-12 col-lg-{{$colLeft}} mb-3">
        <label for="input{{$name}}">{{$label}}</label>
        <input type="{{$type}}" class="{{$class}} @if($errors->has($name)) is-invalid @endif"
               id="input{{ucfirst($name)}}"
               @foreach($inputData as $dataKey => $dataVal)
               data-{{$dataKey}}="{{$dataVal}}"
               @endforeach
               name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}" {{$disabled}}>
        @if($errors->has($name))
            <div class="invalid-feedback">
                {{$errors->first($name)}}
            </div>
        @endif
    </div>
</div>
