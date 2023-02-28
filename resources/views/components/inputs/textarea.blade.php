@php
    $value = old($name, $value ?? '');
    $placeholder = $placeholder ?? '';
    $colLeft = $colLeft ?? 4;
    $class = $class ?? 'form-control';
    $inputData = $inputData ?? [];
@endphp
<div class="row">
    <div class="col-12 col-lg-{{$colLeft}} mb-3">
        <label for="tr{{ucfirst($name)}}">{{$label}}</label>
        <textarea class="form-control @if($errors->has($name)) is-invalid @endif"
                  @foreach($inputData as $dataKey => $dataVal)
                  data-{{$dataKey}}="{{$dataVal}}"
                  @endforeach
                  id="tr{{ucfirst($name)}}" name="{{$name}}" placeholder="{{$placeholder}}"
                  rows="5">{{$value}}</textarea>
        @if($errors->has($name))
            <div class="invalid-feedback">
                {{$errors->first($name)}}
            </div>
        @endif
    </div>
</div>
