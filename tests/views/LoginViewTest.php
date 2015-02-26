<?php

class LoginViewTest extends TestCase {

public function setUp()
{
    parent::setUp();

        $this->crawler = $this->client->request('GET', '/login');

        //Page exists
        $this->assertTrue($this->client->getResponse()->isOk());
}

public function testHasCorrectTitle()
{
    //Has correct title
    $this->assertCount(
        1,
        $this->crawler->filter('title:contains("Log In")')
    );
}
public function testWithNoInput()
{
    //Submit the blank form
    $form = $this->crawler->selectButton('Login')->form();
    $this->client->submit($form);

    //Redirected back
    $this->assertTrue($this->client->getResponse()->isRedirect('http://localhost/login'), $this->client->getResponse());

    //errors on screen
    $this->crawler = $this->client->followRedirect();
    $this->assertCount(1, $this->crawler->filter('.alert:contains("Incorrect")'));
}

public function testWithCorrectInput()
{
    $user = new SteamApi_Admin;
    $user->username = 'admin';
    $user->password = 'password';
    $user->save();

    $form = $this->crawler->selectButton('Login')->form();
    $form['username'] = $user->username;
    $form['password'] = 'password';
    $this->client->submit($form);

    //Redirect success
    $this->assertTrue($this->client->getResponse()->isRedirect('http://localhost/dashboard/'), $this->client->getResponse());
}

// //cant access the login form after already logged in
// public function testRedirectWhenLoggedIn()
// {
//     $user = FactoryMuffin::create('User');
//     $this->be($user);
//     $this->assertTrue(Auth::check());
//     $this->crawler = $this->client->request('GET', '/login');

//     $this->assertTrue($this->client->getResponse()->isRedirect('http://localhost/users/' . $user->id), $this->client->getResponse());
// }

}