<?php

include dirname(__FILE__) . "/../../../vidanova/config/config.inc.php";

//ps_image(SELECT id_image, id_product, position, cover FROM ps_image WHERE 1)
//ps_image_lang(SELECT id_image, id_lang, legend FROM ps_image_lang WHERE 1)
//ps_image_type(SELECT id_image_type, name, width, height, products, categories, manufacturers, suppliers, scenes, stores FROM ps_image_type WHERE 1)
//ps_image_shop(SELECT id_image, id_shop, cover FROM ps_image_shop WHERE 1)


/*
SELECT i.id_image, i.id_product, i.position, i.cover ,il.id_lang, il.legend,iss.id_shop, iss.cover
FROM ps_image i 
inner join ps_image_lang il on il.id_image=i.id_image
inner join ps_image_shop iss on iss.id_image=i.id_image
WHERE 1
*/

$sql =  'SELECT i.id_image, i.id_product, i.position, i.cover ,il.id_lang, il.legend,iss.id_shop, iss.cover
FROM '. _DB_PREFIX_ . 'image i 
inner join '. _DB_PREFIX_ . 'image_lang il on il.id_image=i.id_image
inner join '. _DB_PREFIX_ . 'image_shop iss on iss.id_image=i.id_image
WHERE 1';
$results = Db::getInstance()->ExecuteS($sql);


$sql =  'SELECT id_image_type, name, width, height, products, categories, manufacturers, suppliers, scenes, stores FROM '. _DB_PREFIX_ . 'image_type WHERE products = 1';
$resultst = Db::getInstance()->ExecuteS($sql);


//print_r($resultst);

for($e=0;$e<count($results);$e++){
    $nome=$results[$e]["id_product"];
    $n_caracteres=strlen($nome);
    for($t=0;$t<count($resultst);$t++)
    {
        $nomepath="";
        for($i=0; $i < $n_caracteres ; $i++ ){
           $nomepath =$nomepath."$nome[$i]/";
        }
        if($t==(count($resultst)-1))
        {       
            print $nomepath.$results[$e]["id_product"].".jpg"."\n";            
        }
                
        $nomepath = $nomepath.$results[$e]["id_product"]."-".$resultst[$t]["name"].".jpg";        
        print $nomepath."\n";
    

    
    }
}
?>
