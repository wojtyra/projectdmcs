<?php

namespace backend\dsl\invoice;

use backend\repositories\ProductRepository;
use backend\vosiv\traits\ErrorContainer;

class Product
{
    use ErrorContainer;
    const TAX_VAT_23 = 1;
    /** @var  ProductRepository */
    private $_repository;

    /** @var  int */
    private $_id;
    /** @var  string */
    private $_title;
    /** @var  string */
    private $_description;
    /** @var  float */
    private $_price;
    /** @var  int */
    private $_taxId;
    /** @var  int */
    private $_invice_group_client_id;
    /** @var  int */
    private $_clinet_product_id;


    function __construct($id=null)
    {
        if(!is_null($id))
        {
            $this->_id = $id;
        }
    }

    public function save()
    {
        if(!$this->validation())
        {
            return false;
        }
        return $this->getRepository()->save();
    }

    public function isInDatabase()
    {
        $hash = md5(join('.',[
            $this->getTitle(),
            $this->getDescription(),
            $this->getPrice(),
            $this->getTaxId(),
            $this->getClinetProductId(),
        ]));
        $condition = ['hash'=>$hash,'clinet_product_id'=>$this->getClinetProductId()];
        return $this->getRepository()->findOne($condition) instanceof ProductRepository;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return int
     */
    public function getTaxId()
    {
        return $this->_taxId;
    }

    /**
     * @param int $taxId
     */
    public function setTaxId($taxId)
    {
        $this->_taxId = $taxId;
    }

    /**
     * @return int
     */
    public function getClinetProductId()
    {
        return $this->_clinet_product_id;
    }

    /**
     * @param int $clinet_product_id
     */
    public function setClinetProductId($clinet_product_id)
    {
        $this->_clinet_product_id = $clinet_product_id;
    }

    /**
     * @return ProductRepository
     */
    public function getRepository()
    {
        return $this->_repository;
    }

    /**
     * @param ProductRepository $repository
     */
    public function setRepository(ProductRepository $repository)
    {
        $this->_repository = $repository;
    }

    public function validation()
    {
        $this->_errors = [];
        if(is_null($this->getTitle()))
        {
            $this->addError('Pusty tytuł','title');
        }

        if(is_null($this->getDescription()))
        {
            $this->addError('Pusty tytuł','description');
        }

        if(is_null($this->getPrice()))
        {
            $this->addError('Pusty tytuł','price');
        }

        if(is_null($this->getTaxId()))
        {
            $this->addError('Pusty tytuł','taxId');
        }

        if(is_null($this->getClinetProductId()))
        {
            $this->addError('Pusty tytuł','clinet_product_id');
        }
        return !$this->hasError();
    }

}