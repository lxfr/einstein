<?php
 
namespace app\models;
 
use Yii;
 
class ContentElastic extends \yii\elasticsearch\ActiveRecord
{

    public static $type = 'content';

    public static function index(){
        return "storage";
    }

    public static function type(){
        return self::$type;
    }
 
    public function attributes()
    {
        return [
            'meta_title',
            'meta_description',
            'content',
            'slug',
            'id',
            'type'
        ];
    }

    public function rules()
    {
        return [
            [['meta_title', 'meta_description', 'content', 'slug', 'type', 'id'], 'required'],
            [['content'], 'string'],
            [['meta_title', 'meta_description', 'slug'], 'string', 'max' => 250],
        ];
    }

    public static function indexExists()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        if (!$command->indexExists(static::index()))
        {
            self::createIndex();
        }
    }

    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [
                
                        "analysis" =>[
                            "analyzer" =>[
                                "my_search_analyzer" =>[
                                    "type"=>"custom",
                                    "tokenizer" =>"standard",
                                    "filter" =>["lowercase", "search_synonym","russian_morphology", "english_morphology", "ru_stopwords"]
                                ]
                            ],
                            "filter" =>[
                                "search_synonym" =>[
                                    "ignore_case" =>"true",
                                    "type" =>"synonym",
                                    "synonyms" =>["дом,домик"]
                                ],
                                "ru_stopwords" =>[
                                    "type" =>"stop",
                                    "stopwords" =>""
                                ]
                            ]
                        ]
                    
                
            ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'meta_title' => ['type' => 'text', 'analyzer' => 'my_search_analyzer'],
                    'meta_description'  => ['type' => 'text', 'analyzer' => 'my_search_analyzer'],
                    'content' => ['type' => 'text', 'analyzer' => 'my_search_analyzer'],
                    'slug'  => ['type' => 'text'],
                    'id'  => ['type' => 'long'],
                    'type'  => ['type' => 'text'],
                ],
            ],
        ];
    }
 
    


    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }


    


    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
    
}