window.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');

    const form_span = document.querySelector('.form-span');
    const checkbox = document.querySelector('.form-checkbox'); debugger
    if (checkbox.checked != true) {
        form_span.addEventListener('click', () => {
            checkbox.checked = 'true'; debugger
        });
    } else {
        form_span.addEventListener('click', () => {
            checkbox.checked = 'false'; debugger
        });
    }
    
});