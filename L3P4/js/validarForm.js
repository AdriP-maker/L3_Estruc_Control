document.querySelectorAll('.input-matrix').forEach(function(input) {
    input.addEventListener('keydown', function(e) {
        if (e.key === 'e' || e.key === 'E' || e.key === '+' || e.key === '-') {
            e.preventDefault();
        }
    });
});
 