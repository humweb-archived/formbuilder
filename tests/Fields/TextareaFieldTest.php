<?php

namespace Humweb\FormBuilders\tests\Fields;

use Humweb\FormBuilder\Fields\TextareaField;

/**
 * Test ClassResolver class.
 */
class TextareaFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Humweb\FormBuilder\Fields\AbstractField
     */
    protected $field;


    public function setUp()
    {
        $this->field = new TextareaField('body');
    }

    public function tearDown()
    {
        unset($this->field);
    }

    /**
     * @test
     */
    public function it_can_render_field_with_empty_value()
    {
        $str         = $this->field->render();
        $expectedStr = '<textarea name="body"></textarea>';

        $this->assertEquals($str, $expectedStr);
    }


    /**
     * @test
     */
    public function it_can_render_field_with_plain_text_value()
    {
        $this->field->setValue('Body Text');

        $str         = $this->field->render();
        $expectedStr = '<textarea name="body">Body Text</textarea>';

        $this->assertEquals($str, $expectedStr);
    }

    /**
     * @test
     */
    public function it_can_render_field_with_html_value()
    {
        $this->field->setValue('<b>Body</b>');

        $str         = $this->field->render();
        $expectedStr = '<textarea name="body">&lt;b&gt;Body&lt;/b&gt;</textarea>';

        $this->assertEquals($str, $expectedStr);
    }
}
