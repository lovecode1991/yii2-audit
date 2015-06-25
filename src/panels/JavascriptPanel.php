<?php

namespace bedezign\yii2\audit\panels;

use bedezign\yii2\audit\models\AuditJavascriptSearch;

/**
 * JavascriptPanel
 * @package bedezign\yii2\audit\panels
 */
class JavascriptPanel extends AuditBasePanel
{
    /**
     * @return string
     */
    public function getName()
    {
        return \Yii::t('audit', 'Javascript');
    }

    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->_model->javascripts) . ')</small>';
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        $searchModel = new AuditJavascriptSearch();
        $params = \Yii::$app->request->getQueryParams();
        $params['AuditJavascriptSearch']['entry_id'] = $params['id'];
        $dataProvider = $searchModel->search($params);

        return \Yii::$app->view->render('panels/javascript/detail', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

}