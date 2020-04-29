<?php

namespace App\L\Ex;

use Exception;

/**
 * Class AbstractView
 */
abstract class AbstractView
{
    public $content;

    protected $_template;

    /**
     * AbstractView constructor.
     * 
     * @param $content
     */
    public function __construct($template = null)
    {
        if($template !== null) {
            $this->setTemplate($template);
        }
    }

    /**
     * @param $template
     * 
     * @return void
     */
    public function setTemplate($template): void
    {
        $template = TEMPLATE . '/templates'.DIRECTORY_SEPARATOR. $template;

        if(!file_exists($template)) {
            throw new Exception('Template not exists');
        }

        $this->_template = $template;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->_template;
    }

    /**
     * @return string|null
     */
    protected  function _render() 
    {
        if($this->_template !== null) {
            extract(['content' => $this->content]);
            ob_start();
            include $this->_template;
            return ob_get_clean();
        }

        return '';
    }

    abstract public function addView(AbstractView $view);
    abstract public function addViews(array $views);
    abstract public function render();
}