<?php
namespace ZuluruBootstrap\View\Helper;

use Cake\Routing\Router;
use Cake\View\Helper;

class AccordionHelper extends Helper {
	public $helpers = ['Html'];

	public function accordion($content, $options = []) {
		$options += [
			'accordion' => 'accordion',
			'multipleOpen' => false,
		];

		return $this->Html->tag('div', $content, [
			'class' => 'panel-group',
			'id' => $options['accordion'],
			'role' => 'tablist',
			'aria-multiselectable' => ($options['multipleOpen'] ? 'true' : 'false'),
		]);
	}

	/**
	 * @param $heading string
	 * @param $content string
	 */
	public function panel($heading, $content) {
		return $this->Html->tag('div', $heading . $content, [
			'class' => 'panel panel-default',
		]);
	}

	/**
	 * @param $id string
	 * @param $heading string
	 * @param $options mixed[]
	 */
	public function panelHeading($id, $heading, $options = []) {
		$options += [
			'collapsed' => true,
			'tag' => 'h4',
			'extraButton' => '',
			'accordion' => 'accordion',
		];

		$buttons = $this->button($heading, [
			'class' => 'accordion-toggle' . ($options['collapsed'] ? ' collapsed' : ''),
			'data-toggle' => 'collapse',
			'data-parent' => ($options['accordion'] ? "#{$options['accordion']}" : false),
			'url' => "#{$id}Content",
			'aria-expanded' => ($options['collapsed'] ? 'false' : 'true'),
			'aria-controls' => "{$id}Content",
			'escape' => false,
		]);

		if ($options['extraButton']) {
			$buttons .= ' ' . $options['extraButton'];
		}

		$title = $this->Html->tag($options['tag'], $buttons, ['class' => 'panel-title']);

		return $this->Html->tag('div', $title, [
			'class' => 'panel-heading',
			'role' => 'tab',
			'id' => $id . 'Heading',
		]);
	}

	/**
	 * @param $content string
	 * @param $id string
	 */
	public function panelContent($id, $content = '', $options = []) {
		$options += [
			'collapsed' => true,
			'dynamicUrl' => false,
		];

		$body = $this->Html->tag('div', $content, [
			'id' => "{$id}Panel",
			'class' => 'panel-body',
		]);

		$class = 'panel-collapse ' . ($options['collapsed'] ? 'collapse' : 'in') . ($options['dynamicUrl'] ? ' dynamic-load' : '');
		if (array_key_exists('class', $options)) {
			if (is_array($options['class'])) {
				$options['class'][] = $class;
			} else {
				$options['class'] .= ' ' . $class;
			}
		} else {
			$options['class'] = $class;
		}

		return $this->Html->tag('div', $body, [
			'id' => "{$id}Content",
			'class' => $options['class'],
			'role' => 'tabpanel',
			'aria-labelledby' => "{$id}Heading",
			'data-selector' => ($options['dynamicUrl'] ? "#{$id}Panel" : false),
			'data-url' => ($options['dynamicUrl'] ? Router::url($options['dynamicUrl']) : false),
		]);
	}

	/**
	 * @param $text string
	 * @param $options mixed[]
	 */
	public function button($text, $options = []) {
		$options += [
			'role' => 'button',
			'escape' => true,
			'url' => '#',
		];
		$url = $options['url'];
		unset($options['url']);

		return $this->Html->link($text, $url, $options);
	}

}
