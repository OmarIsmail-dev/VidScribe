# 🎥 VidScribe - AI Video Transcription, Translation 

VidScribe is a full-stack Laravel + Python Flask application that enables users to upload videos, automatically transcribe the speech using OpenAI Whisper, translate it to a target language using AI translation models (Google Translate)

## 🚀 Features

- 🎬 Upload any video (MP4)
- 🧠 Automatic speech recognition using OpenAI Whisper
- 🌍 Translate subtitles to any language using AI (Google )
- 📝 SRT subtitle creation and embedding using FFmpeg
- 🪄 Smart translation model selection (based on BLEU score)
- 🔁 Asynchronous processing (background transcription/translation)
- 🔗 Flask ↔ Laravel Integration via API

## 🛠 Tech Stack

- **Frontend**: Blade (Laravel), Bootstrap 5, SweetAlert, Spinner UI
- **Backend (Core)**: Laravel 10 (PHP), MySQL
- **AI Service**: Flask + Python (Whisper, Deep Translator, M2M100)
- **Media Processing**: FFmpeg, Pydub
- **Background Tasks**: Async processing via Flask
- **Communication**: RESTful APIs between Laravel ↔ Flask

## 🖼️ Screenshots

_(Add these if available: Upload screen, dashboard, transcription view, translated output, video with subtitle)_

## 🔬 Folder Structure

- `/laravel-app` → Laravel frontend + API
- `/flask-app` → Flask backend (transcription + translation)
- `/processed_videos` → Output videos
- `/transcriptions`, `/translations` → Stored assets

## 🎬 Demo

▶️ [Click to watch full demo](https://drive.google.com/file/d/10hipLGCaI1nnFjBcYVncTmPNp3Kj8O1p/view?usp=drive_link)

## 📄 How it works

1. User uploads video via Laravel frontend
2. Laravel calls Flask API (`/api/transcribe`) with video path
3. Flask:
   - Downloads video
   - Uses Whisper to transcribe
   - Translates via Google 
   - Creates SRT file
   - Embeds subtitle on video using ffmpeg
4. Flask sends result to Laravel via `/api/transcription/save`
5. Laravel updates UI to display video, subtitles & download options

## 👨‍💻 Developer

**Omar Ismail**  
📧 `omeresmail946@gmail.com`  
🔗 [GitHub Profile](https://github.com/OmarIsmail-dev)

