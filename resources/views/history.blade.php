@extends('layouts.app')

@section('content')


<style>
.container {
    margin-top: 130px;
    margin-left: 150px;
}

@media (max-width: 1000px) {


    .container{  margin-left: 0px; }
          
      

} 

</style>


<div class="container">
            <div class="row">
            <div class="col-md-8 m-auto">


    <h2>Your Uploaded Videos</h2>

    @if ($videos->isEmpty())
        <p>You haven’t uploaded any videos yet.</p>
    @else
        <ul class="list-group">
            @foreach ($videos as $video)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="" style="text-decoration:none;  " href="{{ route('show', $video->id) }}">
                        {{ $video->title ?? 'Untitled Video' }}
                    </a>
                    <small class="text-muted">{{ $video->created_at->format('Y-m-d H:i') }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</div>
</div>

@endsection
