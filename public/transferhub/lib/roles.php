<?php
require_once __DIR__.'/auth.php';


function require_role(string $role): void {
auth_check();
$u = auth_user();
if (!$u || $u['rol'] !== $role) { http_response_code(403); die('Acceso denegado'); }
}


function can_owner(): bool { $u = auth_user(); return $u && $u['rol']==='owner'; }
function can_proveedor(): bool { $u = auth_user(); return $u && $u['rol']==='proveedor'; }
function can_conductor(): bool { $u = auth_user(); return $u && $u['rol']==='conductor'; }