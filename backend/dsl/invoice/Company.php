<?php
/**
 * User: kuw
 */

namespace backend\dsl\invoice;


use backend\repositories\CompanyRepository;
use backend\vosiv\traits\ErrorContainer;

class Company {
    use ErrorContainer;

    /** @var  CompanyRepository */
    private $_repository;
    /** @var  int */
    private $_id;
    /** @var  string */
    private $_name;
    /** @var  string */
    private $_nip;
    /** @var  int */
    private $_postcode;
    /** @var  string */
    private $_city;
    /** @var  string */
    private $_address;
    /** @var  int */
    private $_invice_group_client_id;
    /** @var  int */
    private $_clinet_company_id;

    /**
     * @return CompanyRepository
     */
    public function getRepository()
    {
        return $this->_repository;
    }

    /**
     * @param CompanyRepository $repository
     */
    public function setRepository($repository)
    {
        $this->_repository = $repository;
    }

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
            $this->getName(),
            $this->getNip(),
            $this->getPostcode(),
            $this->getCity(),
            $this->getAddress(),
        ]));
        $condition = ['hash'=>$hash,'clinet_company_id'=>$this->getClinetCompanyId()];
        return $this->getRepository()->findOne($condition) instanceof CompanyRepository;
    }

    private function validation()
    {
        $this->_errors = [];
        if(is_null($this->getName()))
        {
            $this->addError('Pusty tytuł','name');
        }

        if(is_null($this->getNip()))
        {
            $this->addError('Pusty tytuł','nip');
        }

        if(is_null($this->getPostcode()))
        {
            $this->addError('Pusty tytuł','postcode');
        }

        if(is_null($this->getCity()))
        {
            $this->addError('Pusty tytuł','city');
        }

        if(is_null($this->getClinetCompanyId()))
        {
            $this->addError('Pusty tytuł','clinet_company_id');
        }
        return !$this->hasError();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getNip()
    {
        return $this->_nip;
    }

    /**
     * @param string $nip
     */
    public function setNip($nip)
    {
        $this->_nip = $nip;
    }

    /**
     * @return int
     */
    public function getPostcode()
    {
        return $this->_postcode;
    }

    /**
     * @param int $postcode
     */
    public function setPostcode($postcode)
    {
        $this->_postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * @return int
     */
    public function getInviceGroupClientId()
    {
        return $this->_invice_group_client_id;
    }

    /**
     * @param int $invice_group_client_id
     */
    public function setInviceGroupClientId($invice_group_client_id)
    {
        $this->_invice_group_client_id = $invice_group_client_id;
    }

    /**
     * @return int
     */
    public function getClinetCompanyId()
    {
        return $this->_clinet_company_id;
    }

    /**
     * @param int $clinet_company_id
     */
    public function setClinetCompanyId($clinet_company_id)
    {
        $this->_clinet_company_id = $clinet_company_id;
    }
}