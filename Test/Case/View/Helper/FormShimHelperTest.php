<?php

App::uses('FormShimHelper', 'Shim.View/Helper');
App::uses('ShimTestCase', 'Shim.TestSuite');
App::uses('View', 'View');

class FormShimHelperTest extends ShimTestCase {

	public function setUp() {
		$this->Form = new FormShimHelper(new View(null));

		parent::setUp();
	}

	/**
	 * @return void
	 */
	public function testPostLink() {
		$result = $this->Form->postLink('Foo', '/bar', ['confirm' => 'Some string here']);
		$expected = '<a href="#" onclick="if (confirm(&quot;Some string here&quot;)) { document';
		$this->assertContains($expected, $result);
	}

	/**
	 * @expectedException PHPUNIT_FRAMEWORK_ERROR_DEPRECATED
	 * @expectedExceptionMessage $confirmMessage argument is deprecated as of 2.6. Use `confirm` key in $options instead.
	 * @return void
	 */
	public function testPostLinkInvalid() {
		$this->Form->postLink('Foo', '/bar', [], 'Some string here');
	}

	/**
	 * @return void
	 */
	public function testEnd() {
		$result = $this->Form->end();
		$this->assertSame('</form>', $result);
	}

	/**
	 * @expectedException PHPUNIT_FRAMEWORK_ERROR_DEPRECATED
	 * @expectedExceptionMessage Please use submit() or alike to output buttons. end() is deprecated for this.
	 * @return void
	 */
	public function testEndInvalid() {
		$this->Form->end('Click me');
	}

	/**
	 * @expectedException PHPUNIT_FRAMEWORK_ERROR_DEPRECATED
	 * @expectedExceptionMessage FormHelper::input() is deprecated. Use FormHelper::control() instead.
	 * @return void
	 */
	public function testInput() {
		Configure::write(Shim::FORM_INPUTS, true);
		$this->Form->input('title');
	}

	/**
	 * @expectedException PHPUNIT_FRAMEWORK_ERROR_DEPRECATED
	 * @expectedExceptionMessage FormHelper::control() does not support before, after option(s).
	 * @return void
	 */
	public function testControlDeprecatedOptions() {
		Configure::write(Shim::FORM_INPUTS, true);
		$this->Form->control('title', [
			'before' => '<p>'
			'after' => '</p>',
		]);
	}

}
