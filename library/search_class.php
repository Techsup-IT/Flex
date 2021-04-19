<?php
class search extends db {


	/**
	 *
	 * @param Searching fooders data in menu , products , fooders and fooders_details tables
	 * @param $db database connection identifier
	 * @param $search search keyword
	 */

	public function fooders_search($search) {
		$time_start = microtime(true);
			$fd = parent::run("SELECT f.fooder_id,f.name,f.location_name, fd.status, fd.logo, fd.about_us,fd.average_reviews, fd.number_of_reviews, fd.specialization, fd.daily_hrs, fd.facilities, fd.delivery_areas, fd.type, fd.minimum_order, fd.delivery_time FROM `fooders` AS f
			JOIN `fooders_details` AS fd ON fd.fooder_id = f.fooder_id where f.is_approved='2'")->fetchAll();
  $search =str_replace(',' , ' ',$search);
  $search =str_replace(';' , ' ',$search);
  $search =str_replace(',' , ' ',$search);
  $wordarray=array();

			if(strpos($search, ' '))
			{

				$wordarray=explode(' ',$search);
				$count=count($wordarray);
				foreach($wordarray as $word)
				{
					if(($count-1)==0)
				$fmstm.=" `name` LIKE '%".$word."%' OR `tags` LIKE '%".$word."%' OR `description` LIKE '%".$word."%' ";
					else
				$fmstm.=" `name` LIKE '%".$word."%' OR `tags` LIKE '%".$word."%' OR `description` LIKE '%".$word."%' OR ";

					--$count;
				}

				$fm = parent::run("select `fooder_id` from `fooders_menus` where `status`='1' AND $fmstm GROUP By `fooder_id`")->fetchAll();

			}
			else
			{
				$fm = parent::run("select `fooder_id`,`name` from `fooders_menus` where `status`='1' AND `name` LIKE '%".$search."%' OR `tags` LIKE '%".$search."%' OR `description` LIKE '%".$search."%' GROUP By `fooder_id`")->fetchAll();

			}

$wordarray=array();
if(strpos($search, ' '))
{
	$wordarray=explode(' ',$search);
	$count=count($wordarray);
	foreach($wordarray as $word)
	{
		if(($count-1)==0)
			$fpstm.=" `name` LIKE '%".$word."%' OR `tags` LIKE '%".$word."%' ";
		else
			$fpstm.=" `name` LIKE '%".$word."%' OR `tags` LIKE '%".$word."%' OR ";
		--$count;
	}
	$fp = parent::run("select `fooder_id`  from `fooders_products` where `status`='1' AND $fpstm  GROUP By `fooder_id`")->fetchAll();

}
else
{
	$fp = parent::run("select `fooder_id`,`name`  from `fooders_products` where `status`='1' AND `name` LIKE '%".$search."%' OR `tags` LIKE '%".$search."%' GROUP By `fooder_id`")->fetchAll();

}

for($i=0;$i<5;$i++)
{
if($fp[$i]['name']!='')
{
$rel_p.=$fp[$i]['name']."___";
}
if($fm[$i]['name']!='')
{
	$rel_m.=$fm[$i]['name']."___";
}
if($fd[$i]['name']!='')
{
	$rel_fd.=$fd[$i]['name']."___";
}
}
$rel=rtrim((str_replace('___', ' , ',$rel_p.$rel_m.'---'.$rel_fd))," , ");

if(is_array($fm))
$fm = array_map('current', $fm);
if(is_array($fp))
$fp = array_map('current', $fp);
$merge = array_unique(array_merge($fm,$fp));



$filter=array();
if(is_array($fd))
	foreach ($fd as $array)
	{

    if(preg_match("/\b$search\b/i", $array['name']) || preg_match("/\b$search\b/i", $array['location_name'])
    		 || preg_match("/\b$search\b/i", $array['about_us'])
    		|| preg_match("/\b$search\b/i", $array['specialization']))
        $filter[]=$array['fooder_id'];



	}

	$final_idarray= array_unique(array_merge($merge,$filter));


	$fooder_details=array();
	foreach($fd as $val)
	{
		if(in_array($val['fooder_id'],$final_idarray))
		{
			$f_data[]=$val;
		}
	}


$time_end = microtime(true);
	if(is_array($f_data))
		return json_encode($f_data)."___".round(($time_end-$time_start),5)."___".json_encode($rel);
}
}
?>