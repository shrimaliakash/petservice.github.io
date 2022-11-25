@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() As $error)
        <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(Session::has('errors_arr'))
  <div class="alert alert-danger">
    <ul>
      @foreach(Session::get('errors_arr') As $error)
        <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ Session::get('error') }}
  </div>
@endif
