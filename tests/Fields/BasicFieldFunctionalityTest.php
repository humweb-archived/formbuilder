<?php

namespace Humweb\FormBuilders\Tests\Fields;

use Humweb\FormBuilder\Tests\Fakes\Fields\AbstractFieldFake;

/**
 * Test ClassResolver class.
 *
 * @package Humweb\Features
 */
class BasicFieldFunctionalityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Humweb\FormBuilder\Fields\AbstractField
     */
    protected $field;


    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->field = new AbstractFieldFake('title', 'Test Title');
    }


    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        unset($this->field);
    }


    /**
     * @test
     */
    public function it_can_set_and_get_value()
    {
        $this->assertEquals('Test Title', $this->field->getValue());

        $this->field->setValue('foo');

        $this->assertEquals('foo', $this->field->getValue());
    }


    /**
     * @test
     */
    public function is_can_set_and_get_field_name()
    {
        $this->assertEquals('title', $this->field->getName());

        $this->field->setName('post-title');

        $this->assertEquals('post-title', $this->field->getName());
    }


    /**
     * @test
     */
    public function is_can_set_and_get_attribute_name()
    {
        $this->assertEquals(null, $this->field->getAttribute('id'));

        $this->field->setAttribute('id', 'foo');

        $this->assertEquals('foo', $this->field->getAttribute('id'));
    }


    /**
     * @test
     */
    public function is_can_remove_attribute()
    {
        $this->field->setAttribute('id', 'foo');

        $this->assertEquals('foo', $this->field->getAttribute('id'));

        $this->field->removeAttribute('id');

        $this->assertEquals(null, $this->field->getAttribute('id'));
    }


    /**
     * @test
     */
    public function is_can_prepend_and_get_attributes()
    {
        $this->assertEquals(null, $this->field->getAttribute('class'));

        $this->field->setAttribute('class', 'foo');

        $this->assertEquals('foo', $this->field->getAttribute('class'));

        // Test append
        $this->field->appendAttribute('class', 'bar');

        $this->assertEquals('foo bar', $this->field->getAttribute('class'));
    }


    /**
     * @test
     */
    public function is_can_pluck_an_attributes_value()
    {
        $this->assertEquals(null, $this->field->getAttribute('class'));

        $this->field->setAttribute('class', 'foo bar baz boom bap');
        $this->assertEquals('foo bar baz boom bap', $this->field->getAttribute('class'));

        // Test pluck
        $this->field->pluckAttributeValue('class', 'bar');
        $this->assertEquals('foo baz boom bap', $this->field->getAttribute('class'));

        $this->field->pluckAttributeValue('class', 'bap');
        $this->assertEquals('foo baz boom', $this->field->getAttribute('class'));

        $this->field->pluckAttributeValue('class', 'foo');
        $this->assertEquals('baz boom', $this->field->getAttribute('class'));
    }


    /**
     * @test
     */
    public function is_can_render_attributes_to_key_value_string()
    {

        $this->field->setAttribute('class', 'foo bar');
        $this->field->setAttribute('id', 'title');
        $this->field->setAttribute('value', 'Test Title');

        $str         = $this->field->renderAttributes();
        $expectedStr = 'class="foo bar" id="title" value="Test Title"';

        $this->assertEquals($expectedStr, $str);
    }


    /**
     * @test
     */
    public function is_can_render_form_field()
    {

        $this->field->setAttribute('class', 'foo bar');
        $this->field->setAttribute('id', 'title');
        $this->field->setAttribute('value', 'Test Title');

        $str         = $this->field->render();
        $expectedStr = '<input class="foo bar" id="title" value="Test Title" type="text" name="title" />';

        $this->assertEquals($str, $expectedStr);
    }


    /**
     * @test
     */
    public function is_can_render_value()
    {

        $str         = $this->field->renderValue();
        $expectedStr = 'Test Title';

        $this->assertEquals($str, $expectedStr);
    }

}
