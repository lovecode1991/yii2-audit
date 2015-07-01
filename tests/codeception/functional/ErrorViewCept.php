<?php

use bedezign\yii2\audit\tests\FunctionalTester;
use Codeception\Scenario;
use yii\helpers\Url;

/**
 * @var $scenario Scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('ensure that error view works');
$I->amOnPage(Url::to(['/audit/error/view', 'id' => 1]));
$I->see('Error #1', 'h1');
$I->see('Stack Trace', 'h2');

$I->wantTo('ensure that error view gives error with bad id');
$I->amOnPage(Url::to(['/audit/error/view', 'id' => 99999]));
$I->see('Not Found (#404)', 'h1');