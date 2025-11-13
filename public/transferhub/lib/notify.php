<?php
require_once __DIR__.'/links.php';

function notify_proveedor_reserva($proveedorEmail, $reservaId){
  $url = signed_link('/proveedor/panel.php', ['focus_id'=>$reservaId], 240);
  // Para producción usa PHPMailer (SMTP). Aquí, mail() por simplicidad.
  @mail($proveedorEmail, 'Nueva reserva asignada', "Tienes una reserva para gestionar: $url");
  return $url;
}

function whatsapp_link_proveedor($telefono, $reservaId){
  $url = signed_link('/proveedor/panel.php', ['focus_id'=>$reservaId], 240);
  $msg = rawurlencode("Tienes una reserva para gestionar: $url");
  return 'https://wa.me/'.preg_replace('/\D/','',$telefono).'?text='.$msg;
}

// lib/notify.php (añadir estas funciones)
require_once __DIR__.'/links.php';

function notify_cancel_proveedor(?string $email, ?string $telefono, string $ref, string $fechaHora, string $motivo=''){
  $txt = "Reserva $ref del $fechaHora ha sido CANCELADA".($motivo?": $motivo":".");
  if ($email) @mail($email, "Cancelación de reserva $ref", $txt);
  if ($telefono){
    $msg = rawurlencode($txt);
    // abre WhatsApp en navegador si se usa como link en interfaz
    return 'https://wa.me/'.preg_replace('/\D/','',$telefono).'?text='.$msg;
  }
  return null;
}

function notify_cancel_conductor(?string $email, ?string $telefono, string $ref, string $fechaHora, string $motivo=''){
  $txt = "Tu servicio $ref del $fechaHora ha sido CANCELADO".($motivo?": $motivo":".");
  if ($email) @mail($email, "Servicio cancelado $ref", $txt);
  if ($telefono){
    $msg = rawurlencode($txt);
    return 'https://wa.me/'.preg_replace('/\D/','',$telefono).'?text='.$msg;
  }
  return null;
}
