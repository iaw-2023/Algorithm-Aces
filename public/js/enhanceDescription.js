"use strict";

const nameInput = document.getElementById('name');
const enhanceButton = document.getElementById('enhance-button');
enhanceButton.disabled = nameInput.value.trim() === '';

function enhanceCheckEnable() {
    enhanceButton.disabled = nameInput.value.trim() === '';
}

async function enhanceDescription() {
    if (nameInput.value.trim() !== '') {
        let nameValue = nameInput.value;

        enhanceButton.disabled = true;
        enhanceButton.textContent = "Enhancing...";

        try {
            document.getElementById('desc').value = await gemini(nameValue);
        } catch (error) {
            console.error(error);
            document.getElementById('desc').value = "Error generating description";
        }

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
        return "";
    }

    const data = await response.json();
    return data.response;
}

window.enhanceDescription = enhanceDescription;
window.enhanceCheckEnable = enhanceCheckEnable;
