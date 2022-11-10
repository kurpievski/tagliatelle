<?php

namespace app\controllers\tag;


use app\models\Tag;
use common\models\atlas\AtlasFund;
use common\models\projects\Taxonomy;
use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\web\Response;

/**
 *
 */
class TagSearchAction extends Action
{
    public function run(string $term): array {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $tag = Tag::find()
            ->limit(100)
            ->orderBy('name')
            ->andWhere(['like', 'name', $term]);

        return [
            'success' => true,
            'results' => ArrayHelper::toArray($tag->all(), [
                Tag::class => ['id', 'name']
            ])
        ];
    }

    /**
     * @param false $displayEmailAddress
     * @return JsExpression
     */
    public static function getProcessResultSelect2CallBack(){
        return new JsExpression('
            function(data, params){
                var processedResults = [];
                if(data.success){
                    for(var i in data.results){
                        var result = data.results[i];
                        processedResults.push({
                            id : result.id,
                            text: result.name
                        });
                    }
                }
                return {
                    results: processedResults
                };
            }
        ');
    }
}