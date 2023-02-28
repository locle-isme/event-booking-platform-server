@php
    $colLeft = $colLeft ?? 4;
    $multiple = $multiple ?? false;
    $value = old($name, $value ?? ($multiple ? [] : ""));
    $inputData = $inputData ?? [];
@endphp
<div class="row">
    <div class="col-12 col-lg-{{$colLeft}} mb-3">
        <label for="select{{ucfirst($name)}}">{{$label}}</label>
        @if(!empty($multiple))
            <select class="form-control @if($errors->has($name)) is-invalid @endif" id="select{{ucfirst($name)}}"
                    @foreach($inputData as $dataKey => $dataVal)
                    data-{{$dataKey}}="{{$dataVal}}"
                    @endforeach
                    name="{{$name}}[]" multiple="">
                @foreach($data as $key => $v)
                    <option value="{{$key}}" @if(in_array($key,$value)) selected @endif>{{$v}}</option>
                @endforeach
            </select>
        @else
            <select class="form-control @if($errors->has($name)) is-invalid @endif" id="select{{ucfirst($name)}}"
                    @foreach($inputData as $dataKey => $dataVal)
                    data-{{$dataKey}}="{{$dataVal}}"
                    @endforeach
                    name="{{$name}}">
                @foreach($data as $key => $v)
                    <option value="{{$key}}" @if($value == $key) selected @endif>{{$v}}</option>
                @endforeach
            </select>
        @endif
        @if($errors->has($name))
            <div class="invalid-feedback">
                {{$errors->first($name)}}
            </div>
        @endif
    </div>
</div>
