<?php
/**
 * User: kuw
 */

namespace backend\dsl\invoice;


class InvoiceProduct {
    /**
     * @var Product
     */
    private $_product;
    /**
     * @var int
     */
    private $_count;

    function __construct(Product $p,$count=1)
    {
        $this->_product = $p;
        $this->_count = $count;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->_count;
    }

}