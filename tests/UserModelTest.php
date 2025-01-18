<?php

use PHPUnit\Framework\TestCase;
use app\models\Users\User as UserModel;

class UserModelTest extends TestCase
{
    public function testGetUserById()
    {
        $userModel = $this->createPartialMock(UserModel::class, ['readOne']);
        $userModel->method('readOne')->willReturn([
            'user_id' => 1,
            'username' => 'testuser',
        ]);

        $user = $userModel->getUserById(1);
        $this->assertIsArray($user);
        $this->assertEquals(1, $user['user_id']);
    }

    public function testGetUsersByRole()
    {
        $userModel = $this->createPartialMock(UserModel::class, ['read']);
        $userModel->method('read')->willReturn([
            ['user_id' => 2, 'role' => 'admin'],
            ['user_id' => 3, 'role' => 'admin']
        ]);

        $users = $userModel->getUsersByRole('admin');
        $this->assertCount(2, $users);
        $this->assertEquals('admin', $users[0]['role']);
    }
}