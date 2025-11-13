<?php
require_once __DIR__.'/../config/config.php';

function fs_request(string $method, string $resource, ?array $data=null){
  if (!FS_ENABLED) { throw new Exception('FacturaScripts API desactivada (FS_ENABLED=false).'); }
  $url = rtrim(FS_BASE,'/').'/'.ltrim($resource,'/');
  $ch = curl_init($url);
  $headers = ['Accept: application/json', 'Token: '.FS_TOKEN];
  if (strtoupper($method) === 'GET') {
    curl_setopt($ch, CURLOPT_HTTPGET, true);
  } else {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data ?? [], JSON_UNESCAPED_UNICODE));
  }
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false, // en producción TRUE
    CURLOPT_HTTPHEADER => $headers
  ]);
  $raw = curl_exec($ch);
  if ($raw === false) { $err = curl_error($ch); curl_close($ch); throw new Exception('FS HTTP error: '.$err); }
  $info = curl_getinfo($ch); curl_close($ch);
  $body = json_decode($raw, true);
  return ['code'=>$info['http_code'],'body'=>$body,'raw'=>$raw];
}

/* Clientes (ventas) */
function fs_find_client_by_email_or_name(string $email='', string $name=''){
  $q = [];
  if ($email!=='') $q[] = 'filter[email]='.urlencode($email);
  if ($name!=='')  $q[] = 'filter[name]='.urlencode($name);
  $res = FS_RES_CLIENTS.( $q ? '?'.implode('&',$q) : '' );
  $r = fs_request('GET', $res);
  if ($r['code']===200 && isset($r['body']['data'][0])) return $r['body']['data'][0];
  return null;
}
function fs_find_or_create_client(array $data){
  $found = fs_find_client_by_email_or_name($data['email'] ?? '', $data['name'] ?? '');
  if ($found) return $found;
  $r = fs_request('POST', FS_RES_CLIENTS, $data);
  if ($r['code']>=200 && $r['code']<300 && !empty($r['body']['data'])) return $r['body']['data'];
  throw new Exception('No se pudo crear cliente: '.$r['raw']);
}
function fs_create_sales_invoice(array $invoice){
  $r = fs_request('POST', FS_RES_INVOICES, $invoice);
  if ($r['code']>=200 && $r['code']<300 && !empty($r['body']['data'])) return $r['body']['data'];
  throw new Exception('No se pudo crear factura venta: '.$r['raw']);
}
function fs_get_sales_invoice_pdf_raw(string $id){
  if (!FS_ENDPOINT_INVOICE_PDF) return null;
  $endpoint = sprintf(FS_ENDPOINT_INVOICE_PDF, urlencode($id));
  $r = fs_request('GET', $endpoint);
  if ($r['code']===200) return $r['raw'];
  return null;
}

/* Proveedores (compras) */
function fs_find_supplier_by_nif_or_name(string $nif='', string $name=''){
  $q = [];
  if ($nif!=='')  $q[] = 'filter[identificacion]='.urlencode($nif);
  if ($name!=='') $q[] = 'filter[name]='.urlencode($name);
  $res = FS_RES_SUPPLIERS.( $q ? '?'.implode('&',$q) : '' );
  $r = fs_request('GET', $res);
  if ($r['code']===200 && isset($r['body']['data'][0])) return $r['body']['data'][0];
  return null;
}
function fs_find_or_create_supplier(array $data){
  $found = fs_find_supplier_by_nif_or_name($data['identificacion'] ?? '', $data['name'] ?? '');
  if ($found) return $found;
  $r = fs_request('POST', FS_RES_SUPPLIERS, $data);
  if ($r['code']>=200 && $r['code']<300 && !empty($r['body']['data'])) return $r['body']['data'];
  throw new Exception('No se pudo crear proveedor: '.$r['raw']);
}
function fs_create_supplier_invoice(array $invoice){
  $r = fs_request('POST', FS_RES_SUPPLIER_INVOICES, $invoice);
  if ($r['code']>=200 && $r['code']<300 && !empty($r['body']['data'])) return $r['body']['data'];
  throw new Exception('No se pudo crear factura proveedor: '.$r['raw']);
}
function fs_get_supplier_invoice_pdf_raw(string $id){
  if (!FS_ENDPOINT_SUPPLIER_INVOICE_PDF) return null;
  $endpoint = sprintf(FS_ENDPOINT_SUPPLIER_INVOICE_PDF, urlencode($id));
  $r = fs_request('GET', $endpoint);
  if ($r['code']===200) return $r['raw'];
  return null;
}
