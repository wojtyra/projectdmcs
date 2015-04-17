<?php


use backend\dsl\invoice\User;
use backend\repositories\UserRepository;

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /** @var User */
    private $_user;

    protected function _before()
    {
        $this->_user = new User();
    }

    protected function _after()
    {
//        \AspectMock\Test::clean();
    }

    // tests
    public function testLogin()
    {
        $mocObj = \Codeception\Util\Stub::make(UserRepository::className(),[
            'findOne'=>new UserRepository
        ]);
        $this->_user->setRepository($mocObj);
        verify(
            $this->_user->login("username","password")
        )->notNull();

        $mocObj = \Codeception\Util\Stub::make(UserRepository::className(),[
            'findOne'=> null
        ]);
        $this->_user->setRepository($mocObj);
        verify(
            $this->_user->login("username","password")
        )->null();
    }
    // tests
    public function testTokenValidation()
    {
        $mocObj = \Codeception\Util\Stub::make(UserRepository::className(),[
            'findOne'=>new UserRepository
        ]);
        $this->_user->setRepository($mocObj);
        verify(
            $this->_user->login("username","password")
        )->notNull();

        $mocObj = \Codeception\Util\Stub::make(UserRepository::className(),[
            'findOne'=> null
        ]);
        $this->_user->setRepository($mocObj);
        verify(
            $this->_user->login("username","password")
        )->null();
    }


}