 @if(count($errors) > 0)
        @foreach($errors->all() as $error)
       <div style="color: red;" class="text-center"> {{ $error }} </div>
        @endforeach
  @endif
