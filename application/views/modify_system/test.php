<?php
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url['query'], $params);




foreach($params as $urlParamsKey => $urlParamsValue){
	echo $urlParamsKey . '-' . $urlParamsValue.'<hr/>';	
}


echo 'Test Page';

$characteristic = $this->characteristics_model->getCharacteristicById(12);
$characteristic_data = $characteristic->row();
$fields = $characteristic->field_data();


$fieldSize = $this->common->getFieldMaxLength('characteristic','name');
echo $fieldSize;
$subject = 'test';
$courseNumber = 1213;
$title = 'testitle';
$description = 'roel';
if(strlen($created = $this->course_model->saveCourse($subject, $courseNumber, $title, $description) > 0)){
	echo 'ok';	
}else{
	echo 'hinde';	
}



     $data['organization_id'] = 181;
     $this->load->view('organization',$data);


?>