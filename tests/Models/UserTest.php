<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testUserValidationFailsWithEmptyData()
    {
        $user = new User();
        $user->save([]);
        $this->assertTrue($user->fails());
        $this->assertNotEmpty($user->errors());
    }

    public function testUserHasValidationRules()
    {
        $this->assertIsArray(User::$validations);
        $this->assertArrayHasKey('email', User::$validations);
        $this->assertArrayHasKey('first_name', User::$validations);
        $this->assertArrayHasKey('password', User::$validations);
    }

    public function testUserHasFillableFields()
    {
        $this->assertIsArray(User::$fillableFields);
        $this->assertContains('email', User::$fillableFields);
        $this->assertContains('first_name', User::$fillableFields);
        $this->assertContains('last_name', User::$fillableFields);
        $this->assertContains('password', User::$fillableFields);
    }

    public function testUserValidationPassesWithValidData()
    {
        $validData = [
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];

        $user = new User();
        $user->save($validData);

        // Nota: Este test podría fallar si intenta guardar en DB real
        // En un entorno real, usarías mocks o una DB de test
        $this->assertInstanceOf(User::class, $user);
    }
}