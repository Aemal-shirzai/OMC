 @if(count($errors) > 0)
        @foreach($errors->all() as $error)
      		<p style="color: red;font-size: 13px;" class="text-center"> {{ $error }} </p>
        @endforeach
  @endif
