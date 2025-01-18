<?php

use PHPUnit\Framework\TestCase;
use app\core\BaseModel;
use app\core\Database\Database;

class ConcreteModel extends BaseModel {
    protected $table = 'test_table';
}

class BaseModelTest extends TestCase
{
    private $model;
    private $pdoMock;

    protected function setUp(): void
    {
        // Create PDO mock
        $this->pdoMock = $this->createMock(PDO::class);
        
        // Create test database instance with mock PDO
        Database::createTestInstance($this->pdoMock);
        
        // Create model instance
        $this->model = new ConcreteModel();
    }

    protected function tearDown(): void
    {
        Database::resetInstance();
    }

    public function testCreate()
    {
        $data = ['name' => 'Test'];
        $stmt = $this->createMock(\PDOStatement::class);
        
        $stmt->expects($this->once())
             ->method('execute')
             ->with(array_values($data))
             ->willReturn(true);

        $this->pdoMock->expects($this->once())
                      ->method('prepare')
                      ->willReturn($stmt);

        $result = $this->model->create($data);
        $this->assertTrue($result);
    }

    public function testRead()
    {
        $expectedData = [['id' => 1, 'name' => 'Test']];
        $stmt = $this->createMock(\PDOStatement::class);
        
        $stmt->expects($this->once())
             ->method('fetchAll')
             ->willReturn($expectedData);
        
        $stmt->expects($this->once())
             ->method('execute')
             ->willReturn(true);

        $this->pdoMock->expects($this->once())
                      ->method('prepare')
                      ->willReturn($stmt);

        $result = $this->model->read(['id' => 1]);
        $this->assertEquals($expectedData, $result);
    }

    public function testUpdate()
    {
        $conditions = ['id' => 1];
        $data = ['name' => 'Updated'];
        $stmt = $this->createMock(\PDOStatement::class);
        
        $stmt->expects($this->once())
             ->method('execute')
             ->willReturn(true);

        $this->pdoMock->expects($this->once())
                      ->method('prepare')
                      ->willReturn($stmt);

        $result = $this->model->update($conditions, $data);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $conditions = ['id' => 1];
        $stmt = $this->createMock(\PDOStatement::class);
        
        $stmt->expects($this->once())
             ->method('execute')
             ->with(array_values($conditions))
             ->willReturn(true);

        $this->pdoMock->expects($this->once())
                      ->method('prepare')
                      ->willReturn($stmt);

        $result = $this->model->delete($conditions);
        $this->assertTrue($result);
    }
}