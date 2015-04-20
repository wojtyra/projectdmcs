<?php
/**
 * User: kuw
 */
namespace backend\vosiv\traits;

trait ErrorContainer {
    private $_errors;

    public function getErrors()
    {
        return $this->_errors;
    }

    protected function addError($msg, $attribute,$target = '_self')
    {
        if (!isset($this->_errors[$target]))
        {
            $this->_errors[$target] = [];
        }
        if (!isset($this->_errors[$target][$attribute]))
        {
            $this->_errors[$target][$attribute] = [];
        }
        $this->_errors[$target][$attribute][] = $msg;
    }

    public function hasError()
    {
        return $this->getErrors()!=[];
    }
}