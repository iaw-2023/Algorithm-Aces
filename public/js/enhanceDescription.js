"use strict";

const nameInput = document.getElementById('name');
const enhanceButton = document.getElementById('enhance-button');
enhanceButton.disabled = nameInput.value.trim() === '';

function enhanceCheckEnable(){
    if (nameInput.value.trim() === '') {
        enhanceButton.disabled = true;
    } else {
        enhanceButton.disabled = false;
    }
}

async function enhanceDescription(){
    if (nameInput.value.trim() !== '') {
        let nameValue = nameInput.value;
       
        enhanceButton.disabled = true;
        enhanceButton.textContent = "Enhancing...";

        try {
            let enhancedDescription = await gemini(nameValue);
            document.getElementById('description').value = enhancedDescription;
        } catch (error) {
            console.error(error);
            document.getElementById('description').value = "Error generating description";
        }

        // Rehabilitar el botón después de que se complete la generación
        enhanceButton.disabled = false;
        enhanceButton.textContent = "Enhance Description";
    }
}

async function gemini(productName) {
    const response = await fetch('/gemini/enhance-description', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_name: productName
        })
    });

    if (!response.ok) {
        return 'Error en la llamada a la API de Gemini llamando con '+ productName;
    }

    const data = await response.json();

    const descriptiveText = data.response.candidates[0].content.parts[0].text;

    return descriptiveText;
}


function enhanceBasic(nameValue){
    return "Saracatunga tunga tunga tunga " + nameValue;
}