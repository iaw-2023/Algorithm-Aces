"use strict";

import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js/+esm'

const imageInput = document.getElementById('image');
const fileInput = document.getElementById('image-file');
const uploadButton = document.getElementById('upload-button');
const preview = document.getElementById('image-preview');

async function uploadImage() {
    const file = fileInput.files[0];
    if (!file) {
        alert('You must first select an image.');
        return;
    }

    uploadButton.disabled = true;
    uploadButton.textContent = 'Uploading...';

    try {
        const res = await uploadToSupabaseBucket(file);
        imageInput.value = res;
        preview.src = res;
        preview.style.display = 'block';

    } catch (error) {
        alert('Error when uploading.');
    } finally {
        uploadButton.disabled = false;
        uploadButton.textContent = 'Upload';
    }
}

async function uploadToSupabaseBucket(file) {
    const supabaseUrl = 'https://vvivrtywfxzzjrnepzmm.supabase.co';
    const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZ2aXZydHl3Znh6empybmVwem1tIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODE3Mzk3MDUsImV4cCI6MTk5NzMxNTcwNX0.K1glzkpERU0zS0dGvDx-RMoceIEJ0OKZh8-eWs1V4bk';
    const supabase = createClient(supabaseUrl, supabaseKey);
    const bucket = 'products-images';
    const filePath = `products/${file.name}`;

    let fileExists = false;

    try {
        const { data: existingFile, error: checkError } = await supabase
            .storage
            .from(bucket)
            .download(filePath);

        if (existingFile && !checkError) {
            fileExists = true;
        } else if (checkError?.name !== "StorageUnknownError") {
            throw new Error(`Error checking for existing file: ${JSON.stringify(checkError)}`);
        }

    } catch (err) {
        throw new Error(`Unexpected error when checking file: ${err.message || JSON.stringify(err)}`);
    }

    if (fileExists) {
        console.log("File already exists, retrieving public URL...");
        const { data: publicUrlData } = supabase
            .storage
            .from(bucket)
            .getPublicUrl(filePath);
        return publicUrlData.publicUrl;
    }

    const { data, error } = await supabase.storage.from(bucket).upload(filePath, file);
    if (error) {
        throw new Error("Error uploading file: " + error.message);
    }

    const { data: publicUrlData } = supabase
        .storage
        .from(bucket)
        .getPublicUrl(filePath);
    return publicUrlData.publicUrl;
}

window.uploadImage = uploadImage;
