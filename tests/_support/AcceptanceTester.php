<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * @param string $email
     * @param string $password
     */
    public function login($email, $password)
    {
        $I = $this;
        $I->wantTo(sprintf('login as %s with password %s if not yet', $email, $password));
        $token = $I->grabCookie('XSRF-TOKEN');
        if ($token === null) {
            $I->amOnPage('/login');
            $I->fillField('#email', $email);
            $I->fillField('#password', $password);
            $I->click('Войти');
            $I->waitForElement('#navbar-mobile-dropdown');
        }
        $I->canSeeCookie('XSRF-TOKEN');
    }
}
