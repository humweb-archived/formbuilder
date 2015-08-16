<?php

namespace Humweb\FormBuilder\Resolvers;

/**
 * ClassResolver.
 */
class ClassResolver
{
    protected $suffix        = '';
    protected $delimiter     = '::';
    protected $namespace     = '';
    protected $namespaces    = [];
    protected $resolverCache = [];

    /**
     * @return mixed
     */
    public function make()
    {
        // Retrieve arguments list
        $_args = func_get_args();

        // Grab the first argument which is the class name
        $resolvableName = array_shift($_args);

        $class = $this->resolve($resolvableName);

        switch (count($_args)) {
            case 0:
                $instance = new $class();
                break;
            case 1:
                $instance = new $class($_args[0]);
                break;
            case 2:
                $instance = new $class($_args[0], $_args[1]);
                break;
            case 3:
                $instance = new $class($_args[0], $_args[1], $_args[2]);
                break;
            case 4:
                $instance = new $class($_args[0], $_args[1], $_args[2], $_args[3]);
                break;
            case 5:
                $instance = new $class($_args[0], $_args[1], $_args[2], $_args[3], $_args[4]);
                break;
            default:
                throw new \InvalidArgumentException('Your crazy, that\'s to many arguments.');
        }

        return $instance;
    }

    /**
     * @param string $class
     *
     * @return string
     */
    public function resolve($class)
    {

        // Resolve from cache
        if ($this->hasResolved($class)) {
            return $this->getResolved($class);
        }

        // Default namespace
        $className      = $this->formatClassName($class);
        $assembledClass = '\\'.trim($this->getNamespace(), '\\').'\\'.$className.$this->getSuffix();

        if (class_exists($assembledClass)) {
            return $assembledClass;
        }

        // Check extra namespaces
        if ( ! empty($this->namespaces) && ($class = $this->tryNamespace($class)) !== false) {
            return $class;
        }

        // Check if class is resolvable as-is
        if (class_exists($className)) {
            return $className;
        }

        throw new \InvalidArgumentException('Unable to resolve class: '.$className.' or '.$assembledClass);
    }

    /**
     * Resolver Cache Optimization Section
     */

    protected function hasResolved($signature)
    {
        return isset($this->resolverCache[$signature]);
    }

    protected function getResolved($signature)
    {
        return $this->resolverCache[$signature];
    }

    /**
     * Format class name to "studly case".
     *
     * @param string $name
     *
     * @return string
     */
    protected function formatClassName($name)
    {
        $name = ucwords(str_replace(['-', '_'], ' ', $name));

        return str_replace(' ', '', $name);
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     *
     * @return ClassResolver
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     *
     * @return ClassResolver
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;

        return $this;
    }

    public function tryNamespace($signature)
    {
        if (strpos($signature, $this->delimiter) !== false) {
            list($namespace, $class) = explode($this->delimiter, $signature);

            if (isset($this->namespaces[$namespace])) {
                $class          = $this->formatClassName($class);
                $assembledClass = '\\'.trim($this->namespaces[$namespace], '\\').'\\'.$class.$this->getSuffix();

                if (class_exists($assembledClass)) {
                    return $assembledClass;
                }
            }
        }

        return false;
    }

    public function addNamespace($name, $namespace)
    {
        $this->namespaces[$name] = $namespace;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @param string $delimiter
     *
     * @return ClassResolver
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    protected function putResolved($signature, $resolvedClass)
    {
        $this->resolverCache[$signature] = $resolvedClass;

        return $this;
    }
}
