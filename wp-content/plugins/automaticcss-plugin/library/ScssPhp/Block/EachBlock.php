<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace Automatic_CSS\ScssPhp\Block;

use Automatic_CSS\ScssPhp\Block;
use Automatic_CSS\ScssPhp\Type;

/**
 * @internal
 */
class EachBlock extends Block
{
    /**
     * @var string[]
     */
    public $vars = [];

    /**
     * @var array
     */
    public $list;

    public function __construct()
    {
        $this->type = Type::T_EACH;
    }
}
