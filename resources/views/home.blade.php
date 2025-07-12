@extends('layouts.app')

@section('content')
 
<script>
    window.uploadUrl = "{{ route('videos') }}";
</script>

<style>
.container {
    margin-top: 130px;
    margin-left: 150px;
}




@media (max-width: 1000px) {


    .container{  margin-left: auto; }
          
      

} 

h1{
  display: flex;
    justify-content: center;
    margin-bottom: 80px;
}

div#uploaded-video-result {
    width: 75% !important;
    margin: auto;
    margin-bottom: 22px;
}

.spinner {
    display: inline-block;
    width: 30px;
    height: 30px;
    border: 3px solid rgba(0, 0, 0, 0.2);
    border-top-color: #3498db;
    border-radius: 50%;
    animation: spin 1s ease-in-out infinite;
    margin: 10px auto;
}
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.fade-in {
    opacity: 0;
    animation: fadeIn 2.6s ease-in-out forwards;
}
@keyframes fadeIn {
    to {
        opacity: 1;
    }
}
</style>



           <div class="container">

            <div id="header-message" class="text-center my-4 ">

            <h1>What video will you translate today 🙂?</h1>

            </div>

            <div id="processing-message" class="text-center my-4 d-none fade-in">
            <h5>⏳ Video is being processed...</h5>
            </div>

            <div id="uploaded-video-result" class="w-100 d-none fade-in" >
                         
              
                         
              </div>   
 
               
            <div class="row">
            <div class="col-md-8 m-auto">

                <div class="card">
                    <div class="card-body m-auto">
                    <form id="uploadForm" action="{{route("videos")}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row g-3">
                        <div class="col-xl-3">
                          <label for="Upload-Video" class="form-label">Upload-Video</label>
                <input type="file" class="form-control" id="Upload-Video" name="video" required>
                        </div>

                        <div class="col-xl-3">
                          <label for="title" class="form-label">title</label>
                          <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                                                <div class="col-xl-3">
             <label for="original_language" class="form-label">Original Language</label>
           <select name="original_language" class="form-control" required>
            <option value="en">English</option>
           <option value="ar">Arabic</option>
        <option value="tr">Türkiye </option>

    </select>
</div>

<div class="col-xl-3">
  <label for="target_language" class="form-label">Target Language</label>
  <select class="form-select" name="target_language" required>
    <option value="ar">Arabic</option>
    <option value="fr">French</option>
    <option value="en">English</option>
    <option value="es">Spanish</option>
    <option value="de">German</option>
    <option value="tr">Türkiye </option>
  </select>
</div>


                        <div class="col-xl-2">
                          <label class="form-label d-block">&nbsp;</label>
                          <button type="submit" class="btn btn-primary w-100">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
  <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z"/>
</svg>
                            upload
                          </button>
                        </div>


                      </div>
                    </form>
                  </div>
                </div>

            </div>
            </div>
           </div>


           <script>

const form = document.getElementById('uploadForm');
const newForm = form.cloneNode(true);
form.parentNode.replaceChild(newForm, form);

newForm.addEventListener('submit', function(e) {
    e.preventDefault();

    document.getElementById('header-message')?.classList.add('d-none');
    document.getElementById('processing-message')?.classList.remove('d-none');

    const formData = new FormData(this);

    fetch("{{ route('videos') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(async response => {
        if (!response.ok) {
            const error = await response.json();
            throw error;
        }
        return response.json();
    }) 
    .then(data => {
        document.getElementById('processing-message')?.classList.add('d-none');

        const resultDiv = document.getElementById('uploaded-video-result');
        resultDiv.classList.remove('d-none');
        resultDiv.innerHTML = `
            <video controls width="100%">
                <source src="/storage/${data.video_path}" type="video/mp4">
            </video>
            <p class="mt-2 mb-0"><strong>title:</strong> ${data.title || 'not Found title'}</p>
            <p class="mb-0"><strong>original_language:</strong> ${data.original_language}</p>
            <p class="text-light"><strong>status:</strong> ${data.status}</p>
            <div id="transcription-status" class="mt-3 text-info text-center fade-in">
                <div class="spinner"></div>
                <div>⏳ Waiting for transcription...</div>
            </div>
        `;

        const videoId = data.id;

        let pollInterval = setInterval(() => {
            fetch(`/api/videos/${videoId}/transcriptions`)
                .then(res => res.json())
                .then(transcriptionData => {
                    if (transcriptionData.transcriptions?.length > 0) {
                        clearInterval(pollInterval);
                        document.getElementById('transcription-status')?.remove();

                        let tableHTML = `
                            <h3 class="mt-6">📝 Transcription & Translation</h3>
                            <table class="table mt-3 fade-in">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Text</th>
                                        <th>Language</th>
                                    </tr>
                                </thead>
                                <tbody class="table-dark text-light">
                        `;

                        transcriptionData.transcriptions.forEach(segment => {
                            tableHTML += `
                                <tr>
                                    <td>${segment.text}</td>
                                    <td>${segment.language || '-'}</td>
                                </tr>
                            `;
                        });

                        tableHTML += '</tbody></table>';
                        resultDiv.innerHTML += tableHTML;

                        if (transcriptionData.processed_video_path) {
                            resultDiv.innerHTML += `
                                <h3 class="mt-6">🎬 Translated Video</h3>
                                <video controls width="100%" class="fade-in mt-2">
                                    <source src="/storage/${transcriptionData.processed_video_path}" type="video/mp4">
                                </video>
                            `;
                        }
                    }
                })
                .catch(err => {
                    console.error('Error while polling transcription:', err);
                });
        }, 2000);
    })
    .catch(err => {
        document.getElementById('processing-message')?.classList.add('d-none');
        alert("An error occurred while uploading the video.");
        console.error(err);
    });
});


</script>

<script>

function confirmDelete(deleteUrl, userName) {
    Swal.fire({
        title: "Are you sure?",
        html: "<span style='font-size: 20px;'>Do you want to delete the user: <b>" + userName + "</b>?</span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete!", 
        cancelButtonText: "Cancel",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        width: '600px',  
        padding: '2em',  

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        } 

        
        else {
            Swal.fire("Cancelled", "The user is safe!😇", "error");
        }

    });




}

  
</script>

  
@endsection
