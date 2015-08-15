<?php

namespace Humweb\FormBuilder\Resolvers;

/**
 * ClassResolver.
 */
class ClassResolver
{
    protected $suffix = '';
    protected $delimiter = '::';

    protected $namespaces = [];

    /**
     * @param string $class
     *
     * @return string
     */
    public function resolve($class)
    {

        // Check Built-in Fields
        $className = $this->formatClassName($class);

        $assembledClass = '\\'.trim($this->getNamespace(), '\\').'\\'.$className.$this->getSuffix();

        if (class_exists($assembledClass)) {
            return $assembledClass;
        }

        // Check extra namespaces
        if (!empty($this->namespaces) && ($class = $this->tryNamespace($class)) !== false) {
            return $class;
        }

        // Check if class is resolvable
        if (class_exists($className)) {
            return $className;
        }

        throw new \InvalidArgumentException('Unable to resolve class: '.$className.' or '.$assembledClass);
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
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    public function addNamespace($name, $namespace)
    {
        $this->namespaces[$name] = $namespace;
    }

    public function tryNamespace($signature)
    {
        if (strpos($signature, $this->delimiter) !== false) {
            list($namespace, $class) = explode($this->delimiter, $signature);

            if (isset($this->namespaces[$namespace])) {
                $class = $this->formatClassName($class);
                $assembledClass = '\\'.trim($this->namespaces[$namespace], '\\').'\\'.$class.$this->getSuffix();

                if (class_exists($assembledClass)) {
                    return $assembledClass;
                }
            }
        }

        return false;
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

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
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

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }
}
