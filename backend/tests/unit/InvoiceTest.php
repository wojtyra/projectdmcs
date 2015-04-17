<?php


use backend\dsl\invoice\Invoice;
use backend\dsl\invoice\InvoiceProduct;
use backend\dsl\invoice\Product;
use backend\repositories\InvoiceRepository;
use Codeception\Util\Stub;

class InvoiceTest extends \Codeception\TestCase\Test
{

    /**
     * @var \UserTester
     */
    protected $tester;
    /**
     * @var Invoice
     */
    private $_invoice;


    protected function _before()
    {
        $this->_invoice = new Invoice();
    }

    protected function _after()
    {
    }

    // tests
    public function testSumPrice()
    {
        $invoiceProducts = $this->getProducts();
        $sum = 0;
        foreach ($invoiceProducts as $iProduct)
        {
            $sum += $iProduct->count() * $iProduct->getProduct()->getPrice();
        }
        $this->_invoice->addProduct($invoiceProducts);
        verify($this->_invoice->getPrice())->equals($sum);
        if (isset($iProduct))
        {
            $iProduct->getProduct()->setPrice($iProduct->getProduct()->getPrice() * 2);
            verify($this->_invoice->getPrice())->greaterThan($sum);
        }
    }

    public function testNoGenerator()
    {
        /** @var InvoiceRepository $repo */
        $repo = Stub::make(InvoiceRepository::className(), ['findAll' => [],'save'=>true ]);
        $this->_invoice->setRepository($repo);
        $this->_invoice->addProduct($this->getProducts());
        $this->_invoice->save();
        verify($this->_invoice->getNo())->equals(sprintf(
            '%1$d/%2$d/%3$d',
            date('Y'),
            date('m'),
            1
        ));
        /** @var InvoiceRepository $repo */
        $repo = Stub::make(InvoiceRepository::className(), ['findAll' => [1],'save'=>true ]);
        $nInvoice = new Invoice();
        $nInvoice->setRepository($repo);
        $nInvoice->addProduct($this->getProducts());
        $nInvoice->save();
        verify($nInvoice->getNo())->equals(sprintf(
            '%1$d/%2$d/%3$d',
            date('Y'),
            date('m'),
            2
        ));



    }

    /**
     * @return InvoiceProduct[]
     */
    private function getProducts()
    {
        $product1 = new Product();
        $product1->setTitle("p1");
        $product1->setDescription("opis p1");
        $product1->setPrice(1.1);
        $product1->setTaxId(Product::TAX_VAT_23);
        $product1->setClinetProductId(1);

        $product2 = new Product();
        $product2->setTitle("p2");
        $product2->setDescription("opis p2");
        $product2->setPrice(2.2);
        $product2->setTaxId(Product::TAX_VAT_23);
        $product2->setClinetProductId(2);

        $product3 = new Product();
        $product3->setTitle("p3");
        $product3->setDescription("opis p3");
        $product3->setPrice(3.3);
        $product3->setTaxId(Product::TAX_VAT_23);
        $product3->setClinetProductId(3);
        return [
            new InvoiceProduct($product1),
            new InvoiceProduct($product2,2),
            new InvoiceProduct($product3,3),
        ];
    }

}