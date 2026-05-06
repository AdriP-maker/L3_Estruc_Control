/**
 * JS/app.js
 * Scripts auxiliares del sistema de inventario.
 * Bootstrap 3 y jQuery ya vienen cargados desde L3P4/html/footer.html
 */

$(document).ready(function () {

  // ── Scroll automático al bloque resultado si existe ───────
  if ($('#resultado').length) {
    $('html, body').animate({
      scrollTop: $('#resultado').offset().top - 70
    }, 500);
  }

  // ── Tooltips en campos con error ──────────────────────────
  $('.input-error').tooltip({
    title: 'Valor inválido: debe ser un número ≥ 0',
    placement: 'top',
    trigger: 'focus hover'
  });

  // ── Validación del botón Calcular ─────────────────────────
  var $form    = $('#form-inventario');
  var $btnCalc = $form.find('[type="submit"]');

  function getEstado() {
    var inputs     = $form.find('.input-matrix');
    var operacion  = $('#sel-operacion').val();

    var todosEnCero = inputs.toArray().every(function (inp) {
      var v = inp.value.trim();
      return v === '' || parseFloat(v) === 0 || isNaN(parseFloat(v));
    });

    return {
      todosEnCero: todosEnCero,
      sinOperacion: operacion === ''
    };
  }

  function actualizarBoton() {
    var e = getEstado();
    if (e.todosEnCero || e.sinOperacion) {
      $btnCalc
        .removeClass('btn-primary')
        .addClass('btn-default')
        .css({ opacity: '0.55', cursor: 'not-allowed' });
    } else {
      $btnCalc
        .addClass('btn-primary')
        .removeClass('btn-default')
        .css({ opacity: '1', cursor: 'pointer' });
    }
  }

  // Escuchar cambios en inputs y select
  $form.on('input change', '.input-matrix, #sel-operacion', actualizarBoton);

  // Interceptar submit para mostrar toast si hay datos inválidos
  $form.on('submit', function (ev) {
    var e = getEstado();
    if (e.todosEnCero || e.sinOperacion) {
      ev.preventDefault();
      var msg;
      if (e.todosEnCero && e.sinOperacion) {
        msg = 'Ingresa al menos un valor mayor a cero y selecciona una operación.';
      } else if (e.todosEnCero) {
        msg = 'Ingresa al menos un valor mayor a cero en la matriz.';
      } else {
        msg = 'Selecciona una operación para poder mostrar la tabla.';
      }
      mostrarToast(msg);
    }
  });

  // Estado inicial al cargar la página
  actualizarBoton();

  // Restaurar botón después de limpiar
  $('#btn-limpiar').on('click', function () {
    setTimeout(actualizarBoton, 50);
  });

});

function mostrarToast(mensaje) {
  $('#toast-calc').remove();
  var $toast = $(
    '<div id="toast-calc" role="alert" ' +
    'style="position:fixed;bottom:24px;right:24px;z-index:9999;' +
    'min-width:280px;max-width:400px;' +
    'background:#fff3cd;border:1px solid #ffc107;border-radius:6px;' +
    'padding:14px 40px 14px 16px;box-shadow:0 4px 14px rgba(0,0,0,.2);' +
    'font-size:1rem;color:#856404;">' +
    '<span class="glyphicon glyphicon-warning-sign" style="margin-right:8px;"></span>' +
    mensaje +
    '<button type="button" ' +
    'style="position:absolute;top:8px;right:10px;background:none;border:none;' +
    'font-size:1.2rem;line-height:1;color:#856404;cursor:pointer;" ' +
    'onclick="$(\'#toast-calc\').remove()">&times;</button>' +
    '</div>'
  );
  $('body').append($toast);
  setTimeout(function () { $toast.fadeOut(300, function () { $(this).remove(); }); }, 4000);
}
