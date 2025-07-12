@extends('layouts.app')

@section('content')
 
<style>
.container {
    margin-top: 130px;
    margin-left: 150px;
}
hr {
    margin-top: auto;
}

@media (max-width: 1000px) {


    .container{  margin-left: 0px; }
          
      

} 

</style>

<div class="container">

                <div class="row">
            <div class="col-md-8 m-auto">

    <h2>{{ $video->title ?? 'Untitled Video' }}</h2> 
    <video controls width="100%">
        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
    </video>

    <p><strong>Language:</strong> {{ $video->original_language }}</p>
    <p><strong>Status:</strong> {{ $video->status }}</p>
    <p><strong>Uploaded at:</strong> {{ $video->created_at->format('Y-m-d H:i') }}</p>

    @if ($video->transcriptions)
        <hr>
        <h5>📝 Transcription</h5>
        @foreach($video->transcriptions as $transcription)
    <p>{{ $transcription->text }} </p>

    @endforeach

    @endif

    @if ($video->translations)
        <hr>
        <h5>🎬 Translated Video</h5>
    {{-- <p>{{ $translation->translated_text ?? 'N/A'}}  </p> --}}
<video controls width="100%">
  <source src="{{ asset('storage/' . $video->processed_video_path) }}" type="video/mp4">
    Your browser does not support the video tag.
</video>



    @endif

    @if ($video->voiceOvers)
        <hr>
        <h5>Voiceover</h5>
       @foreach($video->voiceOvers as $voice)
    <audio controls>
        <source src="{{ asset('storage/' . $voice->audio_path) }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endforeach

    @endif

    <a href="{{ route('history') }}" class="btn btn-secondary mt-3">← Back to history</a>
</div>
</div>
</div>

@endsection
