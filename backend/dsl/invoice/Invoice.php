<?php
/**
 * User: kuw
 */

namespace backend\dsl\invoice;



use backend\repositories\InvoiceRepository;
use backend\vosiv\traits\ErrorContainer;

class Invoice {
    use ErrorContainer;
    /** @var  InvoiceRepository */
    private $_repository;
    /**
     * @var InvoiceProduct[]
     */
    private $_products = [];
    /**
     * @var string
     */
    private $_no;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {

    }

    /**
     * @return InvoiceRepository
     */
    public function getRepository()
    {
        return $this->_repository;
    }

    /**
     * @param InvoiceRepository $repository
     */
    public function setRepository($repository)
    {
        $this->_repository = $repository;
    }
    /**
     * @return InvoiceProduct[]
     */
    public function getProducts()
    {
        return $this->_products;
    }
    /**
     * @param InvoiceProduct|InvoiceProduct[] $products
     *
     * @throws \Exception
     */
    public function addProduct($products)
    {
        if (is_array($products) && reset($products) instanceof InvoiceProduct)
        {
            array_walk($products, [$this, '_addProduct']);
        } elseif ($products instanceof InvoiceProduct)
        {
            $this->_addProduct($products);
        } else
        {

            throw new \Exception("Nieobslugiwany typ");
        }
    }
    /**
     * @param InvoiceProduct|InvoiceProduct[] $product
     */
    private function _addProduct(InvoiceProduct $product)
    {
        $this->_products[] = $product;
    }

    public function getPrice()
    {
        $sum = 0;
        foreach($this->getProducts() as $product)
        {
            $sum += $product->getProduct()->getPrice()*$product->count();
        }
        return $sum;
    }

    public function getNo()
    {
        return $this->_no;
    }

    public function save()
    {
        $no  = $this->generateNo();
        if(!$this->validation())
        {
            return false;
        }
        if($this->getRepository()->save())
        {
            $this->_no = $no;
            return true;
        }
        return false;
    }

    private function validation()
    {
        return !$this->hasError();
    }

    private function generateNo()
    {
        return sprintf(
            '%1$d/%2$d/%3$d',
            date('Y'),
            date('m'),
            count($this->getRepository()->findAll())+1
            );
    }
}