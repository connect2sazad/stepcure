<?php
function sc_festivals(){return [
 'diwali'=>['Diwali','A season of light, joy and new beginnings.','fireworks'],
 'holi'=>['Holi','Wishing you a joyful celebration of colours.','splash'],
 'eid'=>['Eid al-Fitr','Eid Mubarak! Wishing you peace and happiness.','stars'],
 'bakr_eid'=>['Eid al-Adha / Bakr Eid','Eid Mubarak! Wishing you and your family joy and togetherness.','stars'],
 'christmas'=>['Christmas','Merry Christmas! Wishing you warmth, peace and joy.','snow'],
 'dussehra'=>['Dussehra','Celebrating hope, courage and the triumph of good.','petals'],
 'new_year'=>['New Year','Here’s to a bright and joyful year ahead.','fireworks'],
 'easter'=>['Easter','Wishing you a peaceful and joyful Easter.','petals'],
 'ramadan'=>['Ramadan','Wishing you a peaceful and blessed Ramadan.','stars'],
 'navratri'=>['Navratri / Durga Puja','Wishing you a vibrant and blessed festive season.','petals'],
 'ganesh_chaturthi'=>['Ganesh Chaturthi','Wishing you joy, wisdom and new beginnings.','petals'],
 'onam'=>['Onam','Wishing you a colourful and joyful Onam.','petals']
];}
function sc_festival_config($preview=true){$catalog=sc_festivals();$id=sc_public_setting('festive_festival','diwali');if(!isset($catalog[$id]))$id='diwali';$enabled=sc_public_setting('festive_enabled','0')==='1';$isPreview=false;$candidate=$_GET['festive_preview']??null;if($preview&&is_string($candidate)&&isset($catalog[$candidate])&&!empty($_SESSION[USER_AUTH])&&admin_can('app_settings','update')){$id=$candidate;$enabled=true;$isPreview=true;}$level=sc_public_setting('festive_intensity','medium');if(!in_array($level,['low','medium','high'],true))$level='medium';$greeting=sc_public_setting('festive_greeting','');return ['enabled'=>$enabled,'festival'=>$id,'name'=>$catalog[$id][0],'greeting'=>$isPreview||$greeting===''?$catalog[$id][1]:$greeting,'effect'=>$catalog[$id][2],'intensity'=>$level,'preview'=>$isPreview];}
function sc_save_festival($request){sc_admin_guard('app_settings','update',$request);$festival=$request['festival']??'';$level=$request['intensity']??'medium';$greeting=trim($request['greeting']??'');if(!isset(sc_festivals()[$festival])||!in_array($level,['low','medium','high'],true)||mb_strlen($greeting)>160)throw new RuntimeException('Choose a festival, an effect level and a greeting up to 160 characters.');$values=['festive_enabled'=>isset($request['enabled'])?'1':'0','festive_festival'=>$festival,'festive_intensity'=>$level,'festive_greeting'=>$greeting];$db=sc_db();$db->begin_transaction();try{foreach($values as $key=>$value){$row=sc_query('SELECT id FROM systemv WHERE variable=? LIMIT 1','s',[$key])->get_result()->fetch_assoc();if($row)sc_query('UPDATE systemv SET value=? WHERE variable=?','ss',[$value,$key]);else sc_query('INSERT INTO systemv (variable,value) VALUES (?,?)','ss',[$key,$value]);}sc_audit('festive_mode.updated');$db->commit();}catch(Throwable $e){$db->rollback();throw $e;}}
