<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit\Framework\Assert as PHPUnit;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;
use Laracasts\Behat\Context\Services\MailTrap;
use Zetas\L5Fixtures\Fixtures;

/**
 * Defines application features from the specific context.
 */
class UIContext extends MinkContext implements Context
{
    use Migrator, DatabaseTransactions, MailTrap;

    private $email;
    private $username;

    /**
     * Seeds the database
     *
     * @beforeScenario
     */
    public function setup() {
        $this->migrate();
        Fixtures::up();
        //Artisan::call('db:seed');
    }

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When I register :name :email
     */
    public function iRegister($name, $email)
    {
        $this->username = $name;
        $this->email = $email;

        $this->visit('/register');
        $this->fillField('username', $name);
        $this->fillField('email', $email);
        $this->fillField('password', 'secret');
        $this->fillField('password_confirmation', 'secret');
        $this->pressButton('Register');
    }

    /**
     * @Then I should have an account
     */
    public function iShouldHaveAnAccount()
    {
        $this->assertSignedIn();
    }

    /**
     * @Given I have an account :name :email
     */
    public function iHaveAnAccount($name, $email)
    {
        $this->iRegister($name, $email);
        Auth::logout();
    }

    /**
     * @Then I should be logged in
     */
    public function iShouldBeLoggedIn()
    {
        $this->assertSignedIn();
    }

    private function assertSignedIn() {
        PHPUnit::assertTrue(Auth::check());
    }

    /**
     * @When I login
     */
    public function iLogin()
    {
        $this->visit('/login');
        $this->fillField('username', $this->username);
        $this->fillField('password', 'secret');
        $this->pressButton('Enter');
    }

    /**
     * @When I login with invalid credentials
     */
    public function iLoginWithInvalidCredentials()
    {
        $this->username = 'invalid';
        $this->iLogin();
    }

    /**
     * @Then I should not be logged in
     */
    public function iShouldNotBeLoggedIn()
    {
        PHPUnit::assertTrue(Auth::guest());

        $this->assertPageAddress('/login');
    }

    /**
     * @Then An email should have been sent
     */
    public function anEmailShouldHaveBeenSent()
    {
        $lastEmail = $this->fetchInbox();
        PHPUnit::assertEquals($this->email, $lastEmail[0]['to_email']);
    }

    /**
     * @When I send an invite to :arg1
     */
    public function iSendAnInviteTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then They receive the invite
     */
    public function theyReceiveTheInvite()
    {
        throw new PendingException();
    }

    /**
     * @When I send an invite to :arg1 without an account
     */
    public function iSendAnInviteToWithoutAnAccount($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then They should not receive the invite
     */
    public function theyShouldNotReceiveTheInvite()
    {
        throw new PendingException();
    }

    /**
     * @Given I have an invite
     */
    public function iHaveAnInvite()
    {
        throw new PendingException();
    }

    /**
     * @When I redeem the invite
     */
    public function iRedeemTheInvite()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be able to register
     */
    public function iShouldBeAbleToRegister()
    {
        throw new PendingException();
    }

    /**
     * @When I redeem an invalid invite
     */
    public function iRedeemAnInvalidInvite()
    {
        throw new PendingException();
    }

    /**
     * @Then I should not be able to register
     */
    public function iShouldNotBeAbleToRegister()
    {
        throw new PendingException();
    }

    /**
     * @Given There are free invites available
     */
    public function thereAreFreeInvitesAvailable()
    {
        throw new PendingException();
    }

    /**
     * @When I check for free invites
     */
    public function iCheckForFreeInvites()
    {
        throw new PendingException();
    }

    /**
     * @When I use a free invite
     */
    public function iUseAFreeInvite()
    {
        throw new PendingException();
    }

    /**
     * @When I view my profile
     */
    public function iViewMyProfile()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see my user information
     */
    public function iShouldSeeMyUserInformation()
    {
        throw new PendingException();
    }

    /**
     * @When I update my password to :arg1
     */
    public function iUpdateMyPasswordTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then My password should be updated
     */
    public function myPasswordShouldBeUpdated()
    {
        throw new PendingException();
    }
}
