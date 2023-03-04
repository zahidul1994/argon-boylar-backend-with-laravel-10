@if(Session::has('message'))
<div class="alert alert-success  fade show" role="alert">
  <strong>{{ Session::get('message') }}</strong>
 
</div>
@endif
