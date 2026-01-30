<?php namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable {
    /** @return static */
    public function extends(...$args);
    public function layoutData(...$args);
    public function layout(...$args);
    public function section(...$args);
}
