from flask import Flask, request, jsonify
from flask_cors import CORS
import whisper
import os
import traceback
import requests
import uuid
from deep_translator import GoogleTranslator
import subprocess
import re

app = Flask(__name__)
CORS(app)

os.environ["PATH"] += os.pathsep + r"D:\ffmpeg-7.1.1-essentials_build\bin"

model = whisper.load_model("small")

SUPPORTED_LANGUAGES = whisper.tokenizer.LANGUAGES

def better_translate(text, target_lang):
    try:
        sentences = re.split(r'(?<=[.!?؟])\s+', text)
        translated_sentences = []
        for sentence in sentences:
            sentence = sentence.strip()
            if sentence:
                translated = GoogleTranslator(source='auto', target=target_lang).translate(sentence)
                translated_sentences.append(translated)
        return ' '.join(translated_sentences)
    except Exception as e:
        print("Translation failed:", str(e))
        return ""

def format_time(seconds):
    hrs = int(seconds // 3600)
    mins = int((seconds % 3600) // 60)
    secs = int(seconds % 60)
    millis = int((seconds - int(seconds)) * 1000)
    return f"{hrs:02}:{mins:02}:{secs:02},{millis:03}"

def create_srt(segments, srt_path):
    with open(srt_path, "w", encoding="utf-8-sig") as f:
        for i, segment in enumerate(segments, start=1):
            f.write(f"{i}\n")
            f.write(f"{format_time(segment['start'])} --> {format_time(segment['end'])}\n")
            f.write(f"{segment['translated_text']}\n\n")

@app.route('/api/transcribe', methods=['POST'])
def transcribe():
    try:
        data = request.get_json()
        video_url = data.get('video_path')
        source_language = data.get('language', 'en')
        target_language = data.get('target_language', 'ar')
        video_id = data.get('video_id')

        if not video_url:
            return jsonify({'error': 'Missing video_path'}), 400

        if source_language not in SUPPORTED_LANGUAGES:
            source_language = 'en'

        response = requests.get(video_url)
        if response.status_code != 200:
            return jsonify({'error': 'Failed to download video'}), 400

        temp_filename = f"temp_{uuid.uuid4().hex}.mp4"
        with open(temp_filename, "wb") as f:
            f.write(response.content)

        print(f"Processing file: {temp_filename}")
        result = model.transcribe(temp_filename, language=source_language, word_timestamps=False)

        if not result or "segments" not in result:
            return jsonify({'error': 'Whisper returned no result'}), 500

        segments = []
        for segment in result["segments"]:
            text = segment["text"].strip()
            translated = better_translate(text, target_language)

            segments.append({
                "start": round(segment["start"], 2),
                "end": round(segment["end"], 2),
                "text": text,
                "language": source_language,
                "translated_text": translated,
                "target_language": target_language
            })

        print("Whisper + Translation DONE")

        srt_filename = f"sub_{uuid.uuid4().hex}.srt"
        srt_path = os.path.join("subtitles", srt_filename)
        os.makedirs("subtitles", exist_ok=True)
        create_srt(segments, srt_path)
        print("✔ SRT path:", srt_path)

        final_video = f"processed_{uuid.uuid4().hex}.mp4"
        full_path = os.path.abspath(os.path.join("D:/Laravel-Project/VidScribe/storage/app/public/videos", final_video))
        os.makedirs(os.path.dirname(full_path), exist_ok=True)
        print("✔ FULL path to save:", full_path)

        command = [
            "ffmpeg", "-y", "-i", temp_filename,
            "-vf", f"subtitles='{srt_path.replace(os.sep, '/')}':force_style='FontName=Tahoma'",
            "-c:a", "copy",
            full_path
        ]

              
        subprocess.run(command, check=True)
        os.remove(temp_filename)

        print(" Final video saved with subtitles:", full_path)

        callback_url = "http://127.0.0.1:8000/api/transcription/save"
        callback_payload = {
            "video_id": video_id,
            "segments": segments,
            "processed_video_path": f"videos/{final_video}"
        }

        print(" Sending transcription + translation to Laravel...")
        callback_response = requests.post(callback_url, json=callback_payload, headers={
            'Accept': 'application/json'
        })

        print(" Callback response status:", callback_response.status_code)

        return jsonify({
            "message": "Transcription + translation done",
            "video_path": full_path,
            "video_id": video_id,
            "segments": segments,
            "processed_video_path": f"videos/{final_video}"
        })

    except Exception as e:
        traceback.print_exc()
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)
