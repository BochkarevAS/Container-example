<?php

use Example\Container;
use PHPUnit\Framework\TestCase;

class Ant {}
class Foo {}
class Bar { function __construct(Foo $foo) {} }
class Baz { function __construct(Bar $bar) {} }

class ContainerTest extends TestCase {

    public function testCreateContanier() {
        $container = new Container();
        $this->assertInstanceOf('Example\Container', $container);
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
}