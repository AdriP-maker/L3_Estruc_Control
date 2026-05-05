document.getElementById('btn-limpiar').addEventListener('click', function() {
    document.querySelectorAll('.input-matrix').forEach(function(input) {
        input.value = 0;
    });
    document.getElementById('sel-operacion').value = '';
});