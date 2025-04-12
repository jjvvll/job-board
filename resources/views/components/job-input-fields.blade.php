<div  {{ $attributes }}>
    <x-label for="{{$for}}" :required="$required">{{$fieldName}}</x-label>
    <x-text-input name="{{$name}}" :type="$type" :value="$value"/>
</div>
