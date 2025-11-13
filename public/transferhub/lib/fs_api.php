<?php
// lib/fs_api.php — Cliente ligero para FS API v3 (form-data)
require_once __DIR__.'/../config/fs.php';

class FSApi {
  private string $api;
  private string $token;

  public function __construct(?string $api = null, ?string $token = null) {
    $this->api   = rtrim($api ?: FS_API_BASE, '/');
    $this->token = $token ?: FS_API_TOKEN;
  }

  private function curl($method, $endpoint, array $data = [], array $headers = []): array {
    $url = $this->api . '/' . ltrim($endpoint, '/');
    $ch  = curl_init();
    $h   = array_merge([
      "Authorization: Bearer {$this->token}",
    ], $headers);

    $method = strtoupper($method);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method === 'GET' && $data) {
      $url .= (str_contains($url,'?') ? '&' : '?') . http_build_query($data);
      curl_setopt($ch, CURLOPT_URL, $url);
    } elseif ($method === 'POST') {
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // form-data (no JSON)
    } elseif ($method === 'PUT') {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    } elseif ($method === 'DELETE') {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $res  = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $ctype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: '';
    if ($res === false) {
      $err = curl_error($ch);
      curl_close($ch);
      return ['ok'=>false, 'http'=>$code, 'error'=>"cURL: $err"];
    }
    curl_close($ch);

    // Intentar parsear JSON
    $json = json_decode($res, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
      // Normalizamos un poco la forma de salida
      return ['ok'=>($code>=200 && $code<300), 'http'=>$code, 'data'=>$json['data'] ?? $json, 'raw'=>$json];
    }

    // No es JSON: devolver envoltorio
    return ['ok'=>($code>=200 && $code<300), 'http'=>$code, 'data'=>null, 'raw'=>$res, 'content_type'=>$ctype];
  }

  // ---------- GENÉRICOS ----------
  public function get(string $ep, array $q = []): array { return $this->curl('GET', $ep, $q); }
  public function post(string $ep, array $form = []): array { return $this->curl('POST', $ep, $form); }
  public function put(string $ep, array $form = []): array { return $this->curl('PUT', $ep, $form); }
  public function delete(string $ep, array $q = []): array { return $this->curl('DELETE', $ep, $q); }

  // ---------- CLIENTES / PROVEEDORES ----------
  public function findCliente(string $query): ?array {
    $r = $this->get(FS_EP_CLIENTES, ['filter'=>"nombre:$query", 'limit'=>1]);
    $d = $r['data'] ?? [];
    if (is_array($d) && isset($d[0])) return $d[0];
    return null;
  }
  public function createCliente(string $nombre, ?string $email=null, ?string $telefono=null): array {
    $r = $this->post(FS_EP_CLIENTES, [
      'nombre'   => $nombre,
      'email'    => $email,
      'telefono' => $telefono
    ]);
    return $r['data'] ?? $r; // siempre array
  }
  public function ensureCliente(string $nombre, ?string $email=null, ?string $telefono=null): array {
    $f = $this->findCliente($email ?: $nombre);
    if ($f) return $f;
    return $this->createCliente($nombre, $email, $telefono);
  }

  public function findProveedor(string $query): ?array {
    $r = $this->get(FS_EP_PROVEEDORES, ['filter'=>"nombre:$query", 'limit'=>1]);
    $d = $r['data'] ?? [];
    if (is_array($d) && isset($d[0])) return $d[0];
    return null;
  }
  public function createProveedor(string $nombre, ?string $email=null, ?string $telefono=null): array {
    $r = $this->post(FS_EP_PROVEEDORES, [
      'nombre'   => $nombre,
      'email'    => $email,
      'telefono' => $telefono
    ]);
    return $r['data'] ?? $r;
  }
  public function ensureProveedor(string $nombre, ?string $email=null, ?string $telefono=null): array {
    $f = $this->findProveedor($email ?: $nombre);
    if ($f) return $f;
    return $this->createProveedor($nombre, $email, $telefono);
  }

  // ---------- DOCUMENTOS DE VENTA ----------
  private function salesEndpoint(): string {
    return (FS_SALES_DOC_KIND==='albaran') ? FS_EP_ALBARAN_CLIENTE : FS_EP_FACTURA_CLIENTE;
  }

  public function createVenta(array $doc): array {
    if (empty($doc['fecha'])) $doc['fecha'] = date('Y-m-d');
    if (empty($doc['lineas']) || !is_array($doc['lineas'])) {
      return ['ok'=>false,'error'=>'Faltan líneas'];
    }
    $form = [
      'codcliente'     => $doc['codcliente'] ?? '',
      'nombrecliente'  => $doc['nombrecliente'] ?? '',
      'fecha'          => $doc['fecha'],
      'observaciones'  => $doc['observaciones'] ?? '',
    ];
    foreach ($doc['lineas'] as $i=>$ln) {
      $form["lineas[$i][descripcion]"]  = $ln['descripcion'] ?? 'Servicio';
      $form["lineas[$i][cantidad]"]     = $ln['cantidad'] ?? 1;
      $form["lineas[$i][pvpunitario]"]  = $ln['pvpunitario'] ?? 0.0;
      $form["lineas[$i][iva]"]          = $ln['iva'] ?? FS_DEFAULT_VAT;
    }
    $r = $this->post($this->salesEndpoint(), $form);
    return $r; // siempre array
  }

  // ---------- DOCUMENTOS DE COMPRA ----------
  private function purchaseEndpoint(): string {
    return (FS_PURCHASE_DOC_KIND==='albaran') ? FS_EP_ALBARAN_PROVEEDOR : FS_EP_FACTURA_PROVEEDOR;
  }

  public function createCompra(array $doc): array {
    if (empty($doc['fecha'])) $doc['fecha'] = date('Y-m-d');
    if (empty($doc['lineas']) || !is_array($doc['lineas'])) {
      return ['ok'=>false,'error'=>'Faltan líneas'];
    }
    $form = [
      'codproveedor'   => $doc['codproveedor'] ?? '',
      'nombre'         => $doc['nombre'] ?? '',
      'fecha'          => $doc['fecha'],
      'observaciones'  => $doc['observaciones'] ?? '',
    ];
    foreach ($doc['lineas'] as $i=>$ln) {
      $form["lineas[$i][descripcion]"] = $ln['descripcion'] ?? 'Servicio';
      $form["lineas[$i][cantidad]"]    = $ln['cantidad'] ?? 1;
      $form["lineas[$i][pvpunitario]"] = $ln['pvpunitario'] ?? 0.0;
      $form["lineas[$i][iva]"]         = $ln['iva'] ?? FS_DEFAULT_VAT;
    }
    $r = $this->post($this->purchaseEndpoint(), $form);
    return $r;
  }
}
