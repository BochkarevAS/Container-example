<?php

namespace Example\Core;

class Container {

    protected $instances = [];

    protected $bindings = [];

    public function instance($key, $value) {
        $this->instances[$key] = $value;

        return $this;
    }

    public function bind($key, $value) {
        $this->bindings[$key] = $value;

        return $this;
    }

    public function make($key) {

        if (array_key_exists($key, $this->instances)) {
            return $this->instances[$key];
        }

        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            return $this->instances[$key] = $resolver($this);
        }

        if ($instance = $this->autoResolve($key)) {
            return $instance;
        }

        throw new \Exception('Not found element into container');
    }

    public function autoResolve($key) {

        if (!class_exists($key)) {
            return false;
        }

        $reflectionClass = new \ReflectionClass($key);

        if (!$reflectionClass->isInstantiable()) {
            return false;
        }

        if (!$constructor = $reflectionClass->getConstructor()) {
            return new $key;
        }

        $params = $constructor->getParameters();
        $args = [];

        try {
            foreach ($params as $param) {
                $paramClass = $param->getClass()->getName();
                $args[] = $this->make($paramClass);
            }
        } catch (\Exception $e) {
            throw new \Exception('Unable to resolve !!!');
        }

        return $reflectionClass->newInstanceArgs($args);
    }
}