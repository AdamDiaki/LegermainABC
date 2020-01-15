<?php


namespace App\Tests\form;


use App\Entity\RequestProject;
use App\Tests\Entity\RequestProjectTest;
use App\Tests\Entity\UserTest;
use http\Client\Curl\User;
use Symfony\Component\Form\Test\TypeTestCase;

class requestFormTest extends TypeTestCase
{

    public function testSubmitValidDataUserType() {

        $formData = [
            'test' => 'test',
            'test2' => 'test2',
        ];

        $userToCompare = new UserTest();
        $form = $this->factory->create(User::class, $userToCompare);

        $user = new UserTest();

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($user, $userToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function testSubmitValidDataRequestType() {

        $formData = [
            'test' => 'test',
            'test2' => 'test2',
        ];

        $RequestToCompare = new RequestProjectTest();
        $form = $this->factory->create(RequestProject::class, $RequestToCompare);

        $request = new RequestProjectTest();

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($request, $RequestToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}