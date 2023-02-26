@php
    $colLeft = $colLeft ?? 4;
    $value = old($name, $value ?? 0);
    $rowClass = $rowClass ?? '';
@endphp
<div class="row {{$rowClass}}">
    <div class="col-12 col-lg-{{$colLeft}} mb-3">
        <div class="custom-control custom-switch">
            <input type="checkbox" name="{{$name}}"
                   class="custom-control-input @if($errors->has($name)) is-invalid @endif" id="input{{ucfirst($name)}}"
                   value="1" @if($value == 1) checked="checked" @endif>

            <label class="custom-control-label" for="input{{ucfirst($name)}}"
                   style="user-select: none">{{$label}}</label>
            @if($errors->has($name))
                <div class="invalid-feedback">
                    {{$errors->first($name)}}
                </div>
            @endif
        </div>
    </div>
</div>
