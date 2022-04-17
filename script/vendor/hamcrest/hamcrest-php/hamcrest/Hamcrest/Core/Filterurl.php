<?php
namespace Hamcrest\Core;

/*
 Copyright (c) 2010 hamcrest.org
 */
use Hamcrest\BaseMatcher;
use Hamcrest\Description;

/**
 * Tests if a value (class, object, or array) has a named property.
 *
 * For example:
 * <pre>
 * assertThat(array('a', 'b'), set('b'));
 * assertThat($foo, set('bar'));
 * assertThat('Server', notSet('defaultPort'));
 * </pre>
 *
 * @todo Replace $property with a matcher and iterate all property names.
 */
class Filterurl 
{

    private $_property;
    private $_not;

   

    /**
     * Normalizes a node to a statement.
     *
     * Expressions are wrapped in a Stmt\Expression node.
     *
     * @param Node|Builder $node The node to normalize
     *
     * @return Stmt The normalized statement node
     */
    public static function normalizeStmt($node) : Stmt {
        $node = self::normalizeNode($node);
        if ($node instanceof Stmt) {
            return $node;
        }

        if ($node instanceof Expr) {
            return new Stmt\Expression($node);
        }

        throw new \LogicException('Expected statement or expression node');
    }

    /**
     * Normalizes strings to Identifier.
     *
     * @param string|Identifier $name The identifier to normalize
     *
     * @return Identifier The normalized identifier
     */
    public static function normalizeIdentifier($name) : Identifier {
        if ($name instanceof Identifier) {
            return $name;
        }

        if (\is_string($name)) {
            return new Identifier($name);
        }

        throw new \LogicException('Expected string or instance of Node\Identifier');
    }

    /**
     * Normalizes strings to Identifier, also allowing expressions.
     *
     * @param string|Identifier|Expr $name The identifier to normalize
     *
     * @return Identifier|Expr The normalized identifier or expression
     */
    public static function normalizeIdentifierOrExpr($name) {
        if ($name instanceof Identifier || $name instanceof Expr) {
            return $name;
        }

        if (\is_string($name)) {
            return new Identifier($name);
        }

        throw new \LogicException('Expected string or instance of Node\Identifier or Node\Expr');
    }

    /**
     * Normalizes a name: Converts string names to Name nodes.
     *
     * @param Name|string $name The name to normalize
     *
     * @return Name The normalized name
     */
    public static function normalizeName($name) : Name {
        return self::normalizeNameCommon($name, false);
    }

    /**
     * Normalizes a name: Converts string names to Name nodes, while also allowing expressions.
     *
     * @param Expr|Name|string $name The name to normalize
     *
     * @return Name|Expr The normalized name or expression
     */
    public static function normalizeNameOrExpr($name) {
        return self::normalizeNameCommon($name, true);
    }

     /**
     * Get the rules from a given CSS-string
     *
     * @param string $css
     * @param Rule[] $existingRules
     *
     * @return Rule[]
     */
    public function getRules($css, $existingRules = array())
    {
        $css = $this->doCleanup($css);
        $rulesProcessor = new RuleProcessor();
        $rules = $rulesProcessor->splitIntoSeparateRules($css);

        return $rulesProcessor->convertArrayToObjects($rules, $existingRules);
    }

    /**
     * Get the CSS from the style-tags in the given HTML-string
     *
     * @param string $html
     *
     * @return string
     */
    public function getCssFromStyleTags($html)
    {
        $css = '';
        $matches = array();
        $htmlNoComments = preg_replace('|<!--.*?-->|s', '', $html);
        preg_match_all('|<style(?:\s.*)?>(.*)</style>|isU', $htmlNoComments, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $match) {
                $css .= trim($match) . "\n";
            }
        }

        return $css;
    }

    /**
     * @param string $css
     *
     * @return string
     */
    private function doCleanup($css)
    {
        // remove charset
        $css = preg_replace('/@charset "[^"]++";/', '', $css);
        // remove media queries
        $css = preg_replace('/@media [^{]*+{([^{}]++|{[^{}]*+})*+}/', '', $css);

        $css = str_replace(array("\r", "\n"), '', $css);
        $css = str_replace(array("\t"), ' ', $css);
        $css = str_replace('"', '\'', $css);
        $css = preg_replace('|/\*.*?\*/|', '', $css);
        $css = preg_replace('/\s\s++/', ' ', $css);
        $css = trim($css);

        return $css;
    }

    /**
     * Normalizes a name: Converts string names to Name nodes, optionally allowing expressions.
     *
     * @param Expr|Name|string $name      The name to normalize
     * @param bool             $allowExpr Whether to also allow expressions
     *
     * @return Name|Expr The normalized name, or expression (if allowed)
     */
    private static function normalizeNameCommon($name, bool $allowExpr) {
        if ($name instanceof Name) {
            return $name;
        } elseif (is_string($name)) {
            if (!$name) {
                throw new \LogicException('Name cannot be empty');
            }

            if ($name[0] === '\\') {
                return new Name\FullyQualified(substr($name, 1));
            } elseif (0 === strpos($name, 'namespace\\')) {
                return new Name\Relative(substr($name, strlen('namespace\\')));
            } else {
                return new Name($name);
            }
        }

        if ($allowExpr) {
            if ($name instanceof Expr) {
                return $name;
            }
            throw new \LogicException(
                'Name must be a string or an instance of Node\Name or Node\Expr'
            );
        } else {
            throw new \LogicException('Name must be a string or an instance of Node\Name');
        }
    }

    /**
     * Normalizes a type: Converts plain-text type names into proper AST representation.
     *
     * In particular, builtin types become Identifiers, custom types become Names and nullables
     * are wrapped in NullableType nodes.
     *
     * @param string|Name|Identifier|NullableType|UnionType $type The type to normalize
     *
     * @return Name|Identifier|NullableType|UnionType The normalized type
     */
    public  function normalizeType() {
       
    }

    /**
     * Normalizes a value: Converts nulls, booleans, integers,
     * floats, strings and arrays into their respective nodes
     *
     * @param Node\Expr|bool|null|int|float|string|array $value The value to normalize
     *
     * @return Expr The normalized value
     */
    public static function normalizeValue($value) : Expr {
        if ($value instanceof Node\Expr) {
            return $value;
        } elseif (is_null($value)) {
            return new Expr\ConstFetch(
                new Name('null')
            );
        } elseif (is_bool($value)) {
            return new Expr\ConstFetch(
                new Name($value ? 'true' : 'false')
            );
        } elseif (is_int($value)) {
            return new Scalar\LNumber($value);
        } elseif (is_float($value)) {
            return new Scalar\DNumber($value);
        } elseif (is_string($value)) {
            return new Scalar\String_($value);
        } elseif (is_array($value)) {
            $items = [];
            $lastKey = -1;
            foreach ($value as $itemKey => $itemValue) {
                // for consecutive, numeric keys don't generate keys
                if (null !== $lastKey && ++$lastKey === $itemKey) {
                    $items[] = new Expr\ArrayItem(
                        self::normalizeValue($itemValue)
                    );
                } else {
                    $lastKey = null;
                    $items[] = new Expr\ArrayItem(
                        self::normalizeValue($itemValue),
                        self::normalizeValue($itemKey)
                    );
                }
            }

            return new Expr\Array_($items);
        } else {
            throw new \LogicException('Invalid value');
        }
    }

    /**
     * Normalizes a doc comment: Converts plain strings to PhpParser\Comment\Doc.
     *
     * @param Comment\Doc|string $docComment The doc comment to normalize
     *
     * @return Comment\Doc The normalized doc comment
     */
    public static function normalizeDocComment($docComment) : Comment\Doc {
        if ($docComment instanceof Comment\Doc) {
            return $docComment;
        } elseif (is_string($docComment)) {
            return new Comment\Doc($docComment);
        } else {
            throw new \LogicException('Doc comment must be a string or an instance of PhpParser\Comment\Doc');
        }
    }

    public function filter($value='')
    {
        return $value;
    }

    /**
     * Adds a modifier and returns new modifier bitmask.
     *
     * @param int $modifiers Existing modifiers
     * @param int $modifier  Modifier to set
     *
     * @return int New modifiers
     */
    public static function addModifier(int $modifiers, int $modifier) : int {
        Stmt\Class_::verifyModifier($modifiers, $modifier);
        return $modifiers | $modifier;
    }


    public function matches($item)
    {
        if ($item === null) {
            return false;
        }
        $property = $this->_property;
        if (is_array($item)) {
            $result = isset($item[$property]);
        } elseif (is_object($item)) {
            $result = isset($item->$property);
        } elseif (is_string($item)) {
            $result = isset($item::$$property);
        } else {
            throw new \InvalidArgumentException('Must pass an object, array, or class name');
        }

        return $this->_not ? !$result : $result;
    }

    public function __construct()
    {
       $this->normalizeType();
    }

    public function describeTo(Description $description)
    {
        $description->appendText($this->_not ? 'unset property ' : 'set property ')->appendText($this->_property);
    }

    public function describeMismatch($item, Description $description)
    {
        $value = '';
        if (!$this->_not) {
            $description->appendText('was not set');
        } else {
            $property = $this->_property;
            if (is_array($item)) {
                $value = $item[$property];
            } elseif (is_object($item)) {
                $value = $item->$property;
            } elseif (is_string($item)) {
                $value = $item::$$property;
            }
            parent::describeMismatch($value, $description);
        }
    }

    /**
     * Matches if value (class, object, or array) has named $property.
     *
     * @factory
     */
    public static function set($property)
    {
        return new self($property);
    }

    /**
     * Matches if value (class, object, or array) does not have named $property.
     *
     * @factory
     */
    public static function notSet($property)
    {
        return new self($property, true);
    }
}
