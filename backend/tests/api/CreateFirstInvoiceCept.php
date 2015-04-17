<?php
function login(ApiTester $I,$valid = true)
{
    $I->sendPOST('?r=user/login', ['username' => 'kuw', 'password' => $valid?'wuk':'wuk_error']);
    $I->seeResponseCodeIs($valid?200:409);
    $I->seeResponseIsJson();
}

$I = new ApiTester($scenario);
$I->wantTo('see login validation');
$I->login('kuw','wuk_error',false);
$I->seeResponseContains('{"result":"error"}');
$I->wantTo('login');

$I->login('kuw','wuk');
$I->seeResponseContains('"result":"ok"');
$I->seeResponseContains('"token":"');
$d = $I->grabDataFromResponseByJsonPath('$.data.token')[0];
