"use strict";

import { createClient } from '@supabase/supabase-js';

console.log('[uploadImage] Módulo cargado.');

const imageInput = document.getElementById('image');
const fileInput = document.getElementById('image-file');
const uploadButton = document.getElementById('upload-button');
const preview = document.getElementById('image-preview');

const supabaseUrl = import.meta.env.VITE_SUPABASE_URL;
const supabaseKey = import.meta.env.VITE_SUPABASE_PUBLISHABLE_KEY;

console.log('[uploadImage] Variables de entorno:', {
    hasSupabaseUrl: Boolean(supabaseUrl),
    supabaseUrl,
    hasSupabaseKey: Boolean(supabaseKey),
});

if (!supabaseUrl || !supabaseKey) {
    console.error('[uploadImage] Faltan variables de entorno de Supabase.');
    throw new Error('Supabase environment variables are not configured.');
}

const supabase = createClient(supabaseUrl, supabaseKey);
console.log('[uploadImage] Cliente de Supabase inicializado.');

console.log('[uploadImage] Elementos encontrados:', {
    imageInput: Boolean(imageInput),
    fileInput: Boolean(fileInput),
    uploadButton: Boolean(uploadButton),
    preview: Boolean(preview),
});

if (fileInput) {
    fileInput.addEventListener('change', () => {
        const file = fileInput.files?.[0];
        console.log('[uploadImage] Archivo seleccionado:', file ? {
            name: file.name,
            type: file.type,
            size: file.size,
        } : 'ninguno');
        console.log('[uploadImage] La selección no sube el archivo automáticamente. Pulsa Upload.');
    });
}

async function uploadImage() {
    console.log('[uploadImage] Se hizo clic en Upload.');

    if (!fileInput) {
        console.error('[uploadImage] No existe el input #image-file.');
        return;
    }

    const file = fileInput.files[0];
    if (!file) {
        console.warn('[uploadImage] No hay ningún archivo seleccionado.');
        alert('You must first select an image.');
        return;
    }

    console.log('[uploadImage] Iniciando upload:', file.name);

    uploadButton.disabled = true;
    uploadButton.textContent = 'Uploading...';

    try {
        const res = await uploadToSupabaseBucket(file);
        console.log('[uploadImage] Upload completado. URL pública:', res);
        imageInput.value = res;
        preview.src = res;
        preview.style.display = 'block';

    } catch (error) {
        console.error('Supabase image upload failed:', error);
        alert(error instanceof Error ? error.message : 'Error when uploading.');
    } finally {
        console.log('[uploadImage] Finalizó el proceso de upload.');
        uploadButton.disabled = false;
        uploadButton.textContent = 'Upload';
    }
}

async function uploadToSupabaseBucket(file) {
    const bucket = 'products-images';
    const safeFileName = file.name.replace(/[^a-zA-Z0-9._-]/g, '_');
    const filePath = `products/${Date.now()}-${safeFileName}`;

    console.log('[uploadImage] Subiendo a Supabase:', {
        bucket,
        filePath,
        type: file.type,
        size: file.size,
    });

    const { error } = await supabase.storage.from(bucket).upload(filePath, file, {
        cacheControl: '3600',
        contentType: file.type || 'application/octet-stream',
        upsert: false,
    });
    if (error) {
        console.error('[uploadImage] Supabase devolvió un error:', error);
        throw new Error(`Error uploading file: ${error.message}`);
    }

    console.log('[uploadImage] Archivo guardado en Supabase:', filePath);

    const { data: publicUrlData } = supabase
        .storage
        .from(bucket)
        .getPublicUrl(filePath);
    console.log('[uploadImage] URL pública generada:', publicUrlData.publicUrl);
    return publicUrlData.publicUrl;
}

window.uploadImage = uploadImage;
console.log('[uploadImage] window.uploadImage quedó disponible:', typeof window.uploadImage);
