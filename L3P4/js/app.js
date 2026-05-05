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

});
