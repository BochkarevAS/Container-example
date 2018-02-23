<?php

use Example\Core\Container;
use Example\Core\Router;
use Example\Service\Registration;
use PHPUnit\Framework\TestCase;

class Ant {}
class Bar {
    private $foo;
    public function __construct(Foo $foo) {
        $this->foo = $foo;
    }
    public function indexAction() { return 1; }
    public function testAction() {
        return $this->foo->indexAction();

    }
}
class Baz {
    public function __construct(Bar $bar) {}
    public function indexAction() { return 2; }
}
class Foo {
    public function indexAction() { return 3; }
}

class ContainerTest extends TestCase {

    public function testCreateContanier() {
        $container = new Container();
        $this->assertInstanceOf('Example\Core\Container', $container);
    }

    public function testInstanceContainer() {
        $container = new Container();
        $instance = new Ant();
        $container->instance(Ant::class, $instance);
        $this->assertSame($container->make(Ant::class), $instance);
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionContainer() {
        $container = new Container();
        $container->make('FakeClass');
    }

    public function testSingletonBindingsContainer() {
        $container = new Container();
        $ant = function () { return new Ant(); };

        $container->bind(Ant::class, $ant);
        $this->assertInstanceOf('Ant', $container->make(Ant::class));
        $ant = $container->make(Ant::class);
        $this->assertSame($ant, $container->make(Ant::class));
    }

    public function testResolveClassContainer() {
        $container = new Container();
        $ant = $container->autoResolve(Ant::class);
        $this->assertInstanceOf('Ant', $ant);
    }

    public function testDependenciesContainer() {
        $container = new Container();
        $baz = $container->make(Baz::class);
        $this->assertInstanceOf('Baz', $baz);
    }

    public function testCreateRouter() {
        $container = new Container();
        $router = new Router($container);

        $val = $router->run('user/registration');
        $this->assertEquals(1, $val);

        $val = $router->run('test/index3');
        $this->assertEquals(3, $val);

        $val = $router->run('test/index4');
        $this->assertEquals(3, $val);
    }

    public function testRouter() {
        $container = new Container();
        $router = $container->make(Router::class);
        $this->assertInstanceOf('\Example\Core\Router', $router);
    }

    public function testRegistration() {
        $container = new Container();
        $regist = new Registration($container);
        $this->assertInstanceOf('\Example\Service\Registration', $regist);
    }
}