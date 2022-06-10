window.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');

    const form_span = document.querySelector('.form-span');
    const checkbox = document.querySelector('.form-checkbox'); 

    form_span.addEventListener('click', () => {
        if (checkbox.checked !== true) {
            checkbox.checked = true; 
        } else {
            checkbox.checked = false; 
        }
    });
    
});