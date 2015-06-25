<?php
/* @var $panel yii\debug\panels\LogPanel */
/* @var $searchModel yii\debug\models\search\Log */
/* @var $dataProvider yii\data\ArrayDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;

echo '<h1>' . Yii::t('audit', 'Javascript') . '</h1>';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'id'           => 'log-panel-detailed-grid',
    'options'      => ['class' => 'detail-grid-view table-responsive'],
    'filterModel'  => $searchModel,
    'columns'      => [
        [
            'attribute' => 'id',
            'options'   => [
                'width' => '80px',
            ],
        ],
        [
            'filter' => $searchModel->typeFilter(),
            'attribute' => 'type',
            'options'   => [
                'width' => '80px',
            ],
        ],
        'message',
        [
            'filter' => $searchModel->originFilter(),
            'attribute' => 'origin'
        ],
        [
            'header' => Yii::t('audit', 'Data'),
            'value' => function ($data) {
                $out = '<a class="data-toggle glyphicon glyphicon-plus" href="javascript:void(0);"></a>';
                $out .= '<pre style="display:none;">';
                $out .= \yii\helpers\VarDumper::dumpAsString($data['data']);
                $out .= '</pre>';
                return $out;
            },
            'format' => 'raw',
        ],
    ],
]);

$js = <<<JS
\$('.data-toggle').click(function(){
    if ($(this).hasClass("glyphicon-plus"))
        $(this).removeClass("glyphicon-plus").addClass("glyphicon-minus").next("pre").show();
    else
        $(this).removeClass("glyphicon-minus").addClass("glyphicon-plus").next("pre").hide();
});
JS;
$this->registerJs($js);
