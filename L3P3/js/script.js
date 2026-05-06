// Variable de control para evitar la duplicación de la tabla
let tablaGenerada = false;

// Gestiona la visualización de notificaciones y errores para el usuario
function mostrarMensaje(texto, tipo="error") {
    const div = document.getElementById("mensaje");
    div.className = "mensaje " + tipo;
    div.innerText = texto;
    div.classList.remove("oculto");
}

// Crea dinámicamente la tabla de entrada según el número de meses especificado
function generarCampos() {
    let meses = document.getElementById("mesesCount").value;
    
    // Validación de entrada para asegurar un rango positivo
    if (meses < 1) {
        mostrarMensaje("Ingrese un número válido de meses");
        return;
    }

    // Oculta mensajes previos e inicializa la estructura de la tabla
    document.getElementById("mensaje").classList.add("oculto");
    let deptos = ["Perfumería", "Hogar", "Zapatería"];
    let html = `<table><thead><tr><th>Departamento</th>`;
    
    // Genera los encabezados de las columnas para cada mes
    for (let i = 1; i <= meses; i++) html += `<th>Mes ${i}</th>`;
    html += `</tr></thead><tbody>`;

    // Genera las filas por departamento y sus respectivos campos de entrada
    deptos.forEach(d => {
        html += `<tr><td><strong>${d}</strong></td>`;
        for (let i = 0; i < meses; i++) {
            html += `<td>
                <input type="number" 
                    min="0" 
                    step="0.01" 
                    oninput="validarInputs(this)">
            </td>`;
        }
        html += `</tr>`;
    });
    html += `</tbody></table>`;

    // Renderiza la tabla en el contenedor y activa los controles de operación
    document.getElementById("tablaContenedor").innerHTML = html;
    document.getElementById("formControls").style.display = "flex";
    document.getElementById("mesesCount").disabled = true;
    tablaGenerada = true;
}

// Recolecta los datos de la interfaz y los envía al servidor mediante Fetch API
async function enviarAPHP() {
    if (!tablaGenerada) return;
    
    const filas = document.querySelectorAll("#tablaContenedor tbody tr");
    const opcion = document.getElementById("opcion").value;
    const meses = document.getElementById("mesesCount").value;

    // Prepara el objeto de datos para la petición POST
    let formData = new FormData();
    formData.append('calcular', 'true');
    formData.append('opcion', opcion);
    formData.append('meses', meses);

    try {
        // Itera sobre la tabla para extraer y validar los valores de venta
        filas.forEach(fila => {
            let depto = fila.cells[0].innerText;
            let inputs = fila.querySelectorAll("input");
            inputs.forEach(input => {
                if (input.value === "") throw new Error("Debe llenar todos los campos");
                formData.append(`ventas[${depto}][]`, input.value);
            });
        });

        // Realiza la comunicación asíncrona con el script de procesamiento PHP
        const response = await fetch('L3P3/php/procesar.php', {
            method: 'POST',
            body: formData
        });

        // Inserta la respuesta del servidor (HTML) en el contenedor de resultados
        const htmlResultado = await response.text();
        document.getElementById("resultado").innerHTML = htmlResultado;

    } catch (err) {
        mostrarMensaje(err.message);
    }
}

// Restringe la entrada de datos en tiempo real para evitar negativos y exceso de decimales
function validarInputs(input) {
    let val = input.value;

    // Elimina valores negativos de forma inmediata
    if (val < 0) {
        input.value = "";
        return;
    }

    // Trunca el valor a un máximo de dos posiciones decimales
    if (val.includes(".")) {
        let partes = val.split(".");
        if (partes[1].length > 2) {
            input.value = parseFloat(val).toFixed(2);
        }
    }
}

// Reinicia completamente el estado de la aplicación
function limpiar() { 
    location.reload(); 
}