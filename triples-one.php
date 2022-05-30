<?php

// Triples for one record (for debugging)

error_reporting(E_ALL);


require_once(dirname(__FILE__) . '/vendor/autoload.php');
require_once(dirname(__FILE__) . '/core.php');

use ML\JsonLD\JsonLD;
use ML\JsonLD\NQuads;

$cuid = new EndyJasmi\Cuid;

$nquads = new NQuads();


$id = '0000-0003-3522-9342';

$directory = $config['cache'] . '/' . id_to_dir($id);

$filename = $directory . '/' . $id . '.json';

$output = $directory . '/' . $id . '.nt';


echo $id . "\n";

$json = file_get_contents($filename);

//echo $json;


$quads = JsonLD::toRdf($json);
$serialized = $nquads->serialize($quads);

//echo $serialized;

$serialized = fix_triples($serialized);

echo $serialized;

echo "\n$filename\n";

file_put_contents($output, $serialized);


?>


