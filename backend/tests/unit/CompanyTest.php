<?php


use backend\repositories\CompanyRepository;
use Codeception\Util\Stub;

class CompanyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCreatingNewCompany()
    {
        /** @var CompanyRepository $repo */
        $repo = Stub::make(CompanyRepository::className(), ['findOne' => null,'save'=>true]);
        $product = new \backend\dsl\invoice\Company();
        $product->setRepository($repo);
        $product->setName("tytul");
        $product->setNip(82722212313);
        $product->setPostcode(12345);
        $product->setCity('Sieradz');
        $product->setAddress('wici 30/20');
        $product->setClinetCompanyId(1);
        verify($product->isInDatabase())->false();
        verify($product->save())->true();
    }
    public function testUpdateCompany()
    {
        /** @var CompanyRepository $repo */
        $repo = Stub::make(CompanyRepository::className(), ['findOne' => new CompanyRepository,'save'=>true]);
        $product = new \backend\dsl\invoice\Company();
        $product->setRepository($repo);
        $product->setName("tytul");
        $product->setNip(82722212313);
        $product->setPostcode(12345);
        $product->setCity('Sieradz');
        $product->setAddress('wici 30/20');
        $product->setClinetCompanyId(1);
        verify($product->isInDatabase())->true();
        verify($product->save())->true();
    }

}