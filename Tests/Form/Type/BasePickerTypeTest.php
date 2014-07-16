<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Sonata\CoreBundle\Tests\Form\Type;

use Sonata\CoreBundle\Date\MomentFormatConverter;
use Sonata\CoreBundle\Form\Type\BasePickerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormView;

class BasePickerTest extends BasePickerType
{
    public function getName()
    {
        return 'base_picker_test';
    }

    protected function getDefaultFormat()
    {
        return DateTimeType::HTML5_FORMAT;
    }
}

class BasePickerFrenchTest extends BasePickerType
{
    public function getName()
    {
        return 'base_picker_french_test';
    }

    protected function getDefaultFormat()
    {
        return 'd/m/Y H:i:s';
    }
}


/**
 * Class BasePickerTypeTest
 *
 * @package Sonata\CoreBundle\Tests\Form\Type
 *
 * @author Hugo Briand <briand@ekino.com>
 */
class BasePickerTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testFinishView()
    {
        $type = new BasePickerTest(new MomentFormatConverter());

        $view = new FormView();
        $form = new Form($this->getMock('Symfony\Component\Form\FormConfigInterface'));

        $type->finishView($view, $form, array());

        $this->assertArrayHasKey('moment_format', $view->vars);
        $this->assertArrayHasKey('dp_options', $view->vars);

        foreach ($view->vars['dp_options'] as $dpKey => $dpValue) {
            $this->assertFalse(strpos($dpKey, "_"));
            $this->assertFalse(strpos($dpKey, "dp_"));
        }

        $this->assertEquals('text', $view->vars['type']);
    }
}

/**
 * Class BasePickerFrenchTypeTest
 *
 * @package Sonata\CoreBundle\Tests\Form\Type
 *
 * @author Antoine Rouault de Coligny <antoine@rouaultdecoligny.fr>
 */
class BasePickerFrenchTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testFinishView()
    {
        $type = new BasePickerFrenchTest(new MomentFormatConverter());

        $view = new FormView();
        $form = new Form($this->getMock('Symfony\Component\Form\FormConfigInterface'));

        $type->finishView($view, $form, array());

        $this->assertArrayHasKey('moment_format', $view->vars);
        $this->assertArrayHasKey('dp_options', $view->vars);

        foreach ($view->vars['dp_options'] as $dpKey => $dpValue) {
            $this->assertFalse(strpos($dpKey, "_"));
            $this->assertFalse(strpos($dpKey, "dp_"));
        }

        $this->assertEquals('text', $view->vars['type']);
    }
}
