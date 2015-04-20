<?php
/**
 * User: kuw
 */

namespace backend\repositories;


use yii\base\Object;

abstract class Repository extends Object
{
    const STATE_NEW = 1;
    const STATE_LOADED = 2;
    private $_state = 1;

    public function findOne($condition)
    {
        $this->setRepositoryState(self::STATE_LOADED);
        return new static();
    }
    public function findAll()
    {
        return [];
    }

    public function save()
    {
        $this->setRepositoryState(self::STATE_LOADED);
        return true;
    }

    private function setRepositoryState($state)
    {
        $this->_state = $state;
    }

    public function getRepositoryState()
    {
        return $this->_state;
    }
}