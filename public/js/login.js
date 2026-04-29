document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', () => {
        button.classList.add('button-clicked');
        setTimeout(() => button.classList.remove('button-clicked'), 200);
    });
});
