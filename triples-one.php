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
$id = '0000-0003-4013-3804';

$directory = $config['cache'] . '/' . id_to_dir($id);

$files = scandir($directory);

$output = $directory . '/' . $id . '.nt';

$nt_output = '';


foreach ($files as $filename)
{
	if (preg_match('/' . $id . '(.*)\.json/', $filename))
	{
		$json = file_get_contents($directory . '/' . $filename);

		// fix context
		{
			$obj = json_decode($json);
			if (!isset($obj->{'@context'}->sameAs))
			{
	
				$sameAs = new stdclass;
				$sameAs->{'@id'} = "sameAs";
				$sameAs->{'@type'} = "@id";
				$obj->{'@context'}->sameAs = $sameAs;
		
				$json = json_encode($obj);
			}
		}

		//echo $json;

		$quads = JsonLD::toRdf($json);
		$serialized = $nquads->serialize($quads);

		//echo $serialized;

		$serialized = fix_triples($serialized);
	
		echo $serialized;
	
		$nt_output .= $serialized;
	}
}
	

echo "\n$filename\n";

file_put_contents($output, $nt_output);


?>


