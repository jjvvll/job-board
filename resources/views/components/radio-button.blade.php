@foreach  ($category as $key => $value)
    <label for="{{$name}}"  class="mb-1 items-center flex">
        <input type="radio" name="{{$name}}" value="{{$value}}"
        @checked(request('experience') == $value)/>
        <span class="ml-2">{{$key}}</span>
    </label>
@endforeach
