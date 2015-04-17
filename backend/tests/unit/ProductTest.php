<?php


use backend\dsl\invoice\Product;
use backend\repositories\ProductRepository;
use Codeception\Util\Stub;

class ProductTest extends \Codeception\TestCase\Test
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
    public function testCreatingNewProduct()
    {
        /** @var ProductRepository $repo */
        $repo = Stub::make(ProductRepository::className(), ['findOne' => null,'save'=>true]);
        $product = new Product();
        $product->setRepository($repo);
        $product->setTitle("tytul");
        $product->setDescription("opis");
        $product->setPrice(2.2);
        $product->setTaxId(Product::TAX_VAT_23);
        $product->setClinetProductId(1);
        verify($product->isInDatabase())->false();
        verify($product->save())->true();

    }
    // tests
    public function testUpdateProduct()
    {
        /** @var ProductRepository $repo */
        $repo = Stub::make(ProductRepository::className(), ['findOne' => new ProductRepository,'save'=>true]);
        $product = new Product();
        $product->setTitle("tytul");
        $product->setDescription("opis");
        $product->setPrice(2.2);
        $product->setTaxId(Product::TAX_VAT_23);
        $product->setClinetProductId(1);
        $product->setRepository($repo);
        verify($product->isInDatabase())->true();
        verify($product->save())->true();
    }
    // tests
    public function testValidation()
    {
        /** @var ProductRepository $repo */
        $product = new Product();

        verify($product->validation())->false();
        verify(count($product->getErrors()['_self']))->equals(5);
        verify($product->save())->false();

        $product->setTitle("tytul");
        verify($product->validation())->false();
        verify(count($product->getErrors()['_self']))->equals(4);
        verify($product->save())->false();

        $product->setDescription("opis");
        verify($product->validation())->false();
        verify(count($product->getErrors()['_self']))->equals(3);
        verify($product->save())->false();

        $product->setPrice(2.2);
        verify($product->validation())->false();
        verify(count($product->getErrors()['_self']))->equals(2);
        verify($product->save())->false();

        $product->setTaxId(Product::TAX_VAT_23);
        verify($product->validation())->false();
        verify(count($product->getErrors()['_self']))->equals(1);
        verify($product->save())->false();

        $product->setClinetProductId(1);
        verify($product->validation())->true();
        verify(count($product->getErrors()))->isEmpty();
    }

}