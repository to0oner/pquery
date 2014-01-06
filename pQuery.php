<?php

/**
 * @author Todd Burry <todd@vanillaforums.com>
 * @package pQuery
 * @license http://opensource.org/licenses/LGPL-2.1 LGPL-2.1
 */

use pQuery\IQuery;

/**
 * A jQuery-like object for php.
 */
class pQuery implements IQuery {
    /// Properties ///

    /**
     * @var IQuery[]
     */
    protected $nodes = array();

    /// Methods ///

    public function __construct($nodes = array()) {
        $this->nodes = $nodes;
    }

    public function addClass($classname) {
        foreach ($this->nodes as $node) {
            $node->addClass($classname);
        }
        return $this;
    }

    public function after($content) {
        foreach ($this->nodes as $node) {
            $node->after($content);
        }
        return $this;
    }

    public function append($content) {
        foreach ($this->nodes as $node) {
            $node->append($content);
        }
        return $this;
    }

    public function attr($name, $value = null) {
        if (empty($this->nodes) && $value === null)
            return '';

        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->attr($name);
            $node->attr($name, $value);
        }
        return $this;
    }

    public function before($content) {
        foreach ($this->nodes as $node) {
            $node->before($content);
        }
        return $this;
    }

    public function clear() {
        foreach ($this->nodes as $node) {
            $node->clear();
        }
        return $this;
    }

    public function count() {
        return count($this->nodes);
    }

    /**
     * Format/beautify a DOM.
     *
     * @param pQuery\DomNode $dom The dom to format.
     * @param array $options Extra formatting options. See {@link pQuery\HtmlFormatter::$options}.
     * @return bool Returns `true` on sucess and `false` on failure.
     */
    public static function format($dom, $options = array()) {
        $formatter = new pQuery\HtmlFormatter($options);
        return $formatter->format($dom);
    }

    public function hasClass($classname) {
        foreach ($this->nodes as $node) {
            if ($node->hasClass($classname))
                return true;
        }
        return false;
    }

    public function html($value = null) {
        if (empty($this->nodes) && $value === null)
            return '';

        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->html();
            $node->html($value);
        }
        return $this;
    }

    /**
     * Query a file or url.
     *
     * @param string $path The path to the url.
     * @param resource $context A context suitable to be passed into {@link file_get_contents}
     * @return pQuery\DomNode Returns the root dom node for the html file.
     */
    public static function parseFile($path, $context = null) {
        $html_str = file_get_contents($path, false, $context);
        return static::parseStr($html_str);
    }

    /**
     * Query a string of html.
     *
     * @param string $html
     * @return pQuery\DomNode Returns the root dom node for the html string.
     */
    public static function parseStr($html) {
        $parser = new pQuery\Html5Parser($html);
        return $parser->root;
    }

    public function prepend($content = null) {
        foreach ($this->nodes as $node) {
            $node->prepend($content);
        }
        return $this;
    }

    public function prop($name, $value = null) {
        if (empty($this->nodes) && $value === null)
            return '';

        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->prop($node);
            $node->prop($name, $value);
        }
        return $this;
    }

    public function remove($selector = null) {
        foreach ($this->nodes as $node) {
            $node->remove($selector);
        }
        if ($selector === null)
            $this->nodes = array();

        return $this;
    }

    public function removeAttr($name) {
        foreach ($this->nodes as $node) {
            $node->removeAttr($name);
        }
        return $this;
    }

    public function removeClass($classname) {
        foreach ($this->nodes as $node) {
            $node->removeClass($node);
        }
        return $this;
    }

    public function removeProp($name) {
        foreach ($this->nodes as $node) {
            $node->removeProp($name);
        }
        return $this;
    }

    public function tagName($value = null) {
        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->tagName();
            $node->tagName($value);
        }
        return $this;
    }

    public function text($value = null) {
        if (empty($this->nodes) && $value === null)
            return '';

        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->text();
            $node->text($value);
        }
        return $this;
    }

    public function toggleClass($classname, $switch = null) {
        foreach ($this->nodes as $node) {
            $node->toggleClass($classname, $switch);
        }

        return $this;
    }

    public function unwrap() {
        foreach ($this->nodes as $node) {
            $node->unwrap();
        }
        return $this;
    }

    public function val($value = null) {
        if (empty($this->nodes) && $value === null)
            return '';

        foreach ($this->nodes as $node) {
            if ($value === null)
                return $node->val();
            $node->val($value);
        }
        return $this;
    }

    public function wrap($wrapping_element) {
        foreach ($this->nodes as $node) {
            $node->wrap($wrapping_element);
        }
        return $this;
    }

    public function wrapInner($wrapping_element) {
        foreach ($this->nodes as $node) {
            $node->wrapInner($wrapping_element);
        }
        return $this;
    }
}