<?php

namespace Humweb\FormBuilder\tests\Resolver;

use Humweb\FormBuilder\Resolvers\FieldResolver;

/**
 * Test ClassResolver class.
 */
class ClassResolverTest extends \PHPUnit_Framework_TestCase
{
    protected $resolver;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->resolver = new FieldResolver();
        $this->resolver->setNamespace('Humweb\\FormBuilder\\Fields')->setSuffix('Field');
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        unset($this->resolver);
    }

    /**
     * @test
     */
    public function is_resolves_class_from_default_namespace()
    {
        $expected = '\\'.$this->resolver->getNamespace().'\\TextField';

        $actual = $this->resolver->resolve('Text');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function is_resolves_class_will_full_namespace()
    {
        $expected = 'Humweb\FormBuilder\Fields\TextField';

        $actual = $this->resolver->resolve('Humweb\FormBuilder\Fields\TextField');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function is_resolves_with_added_namespace()
    {
        $this->resolver->addNamespace('tests', 'Humweb\FormBuilder\Tests\Fakes\Fields');

        $expected = '\Humweb\FormBuilder\Tests\Fakes\Fields\TextField';
        $actual = $this->resolver->resolve('tests::text');

        $this->assertEquals($expected, $actual);

        // Check if class is instantiable
        $class = new $actual('title', 'val');
        $this->assertInstanceOf($expected, $class);
    }

    /**
     * @test
     */
    public function is_throws_exception_when_unresolved()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->resolver->resolve('App\Foo\Bar\Baz');
    }
}
