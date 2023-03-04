												
												
@if ($errors->any())
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="fas fa-bell"></i> {{count($errors)}} Errors </span>
   @foreach ($errors->all() as $error)
    <span class="alert-text">{{ $error }}</span>
    @endforeach
  </div>
@endif


