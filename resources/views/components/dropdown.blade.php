@props(['name'])
<div class="dropdown">
    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-plus"
    aria-hidden="true"></i> {{ $name }}
    </a>
  
    <ul class="dropdown-menu">
      {{ $slot }}
    </ul>
  </div>