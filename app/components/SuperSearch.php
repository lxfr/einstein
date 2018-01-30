<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\Html;
use dastanaron\translit\Translit as Translit;

class SuperSearch extends Component
{

	private $elastic;
	
	public function init(){
		parent::init();
		$this->elastic = new \app\models\ContentElastic();
		
		$this->elastic::indexExists();
		
	}

    public function add(\yii\db\ActiveRecord $ar,$type = 'content')
    {
    	\app\models\ContentElastic::$type = $type;
    	$this->elastic->meta_title  = $ar->meta_title;
        $this->elastic->meta_description  = $ar->meta_description;

        //fixme, костыль
        if (!isset($ar->content))
        {
        	$this->elastic->content = $ar->complex_description;
        }
        else
        {
        	$this->elastic->content = $ar->content;
        }
        
        $this->elastic->slug = $ar->slug;
        $this->elastic->setPrimaryKey($ar->id); //меняем _id типа в индексе, берем из ActiveRecord-a
        $this->elastic->id = $ar->id;
        $this->elastic->type = $type;
        if ($this->elastic->insert()) {
            return true;
        } else {
            return false;
        }
	}

	public function update(\yii\db\ActiveRecord $ar,$type = 'content')
    {

    	\app\models\ContentElastic::$type = $type;
    	$searchElastic = $this->elastic->get($ar->id);
    	

        if ($searchElastic->delete())
        {
        	$searchElastic->setPrimaryKey($ar->id); //недоступно
	    	$searchElastic->meta_title  = $ar->meta_title;
	        $searchElastic->meta_description  = $ar->meta_description;
	        //fixme, костыль
	        if (!isset($ar->content))
	        {
	        	$searchElastic->content = $ar->complex_description;
	        }
	        else
	        {
	        	$searchElastic->content = $ar->content;
	        }
	        $searchElastic->slug = $ar->slug;
	        $searchElastic->type = $type;
	        $searchElastic->id = $ar->id;

        	if ($searchElastic->insert()) {
            	return true;
	        } else {
	            return false;
	        }
        }
        else
        {
        	return false;
        }
        
	}

	public function delete(int $id,$type = 'content')
    {

    	\app\models\ContentElastic::$type = $type;
    	$searchElastic = $this->elastic->get($id);

        if ($searchElastic->delete())
        {
            return true;
        }
        else
        {
        	return false;
        }
        
	}

	public static function search ($q)
	{
		//параметры поиска
		$translit = new Translit();
		$params = [
		    'multi_match' => [
		    	'query' =>    $translit->translit($q, false, 'en-ru'), 
      			'fields'=> [ "content", "slug", "meta_description", "meta_title" ],
      			"analyzer" => "my_search_analyzer"
		    ]
		];

		//ищем без транслита
		\app\models\ContentElastic::$type = NULL;
		$result = \app\models\ContentElastic::find()->query($params)->all();

		return $result;
	}
}