<?php

namespace Haythem\DynamicField;

use Laravel\Nova\Fields\Field;

class DynamicField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'dynamic-field';

    public function callEvery($callEvery = 2000)
    {
        return $this->withMeta(["callEvery" => $callEvery]);
    }
    public function endPoint($endPoint = "")
    {
        return $this->withMeta(["endPoint" => $endPoint]);
    }
    /**
     *
     * @param bool $markAsDone
     * @param string $defaultValue value to set when its marked as done
     * @return $this
     */
    public function markAsDone($markAsDone = false, $defaultValue = "")
    {
        return $this->withMeta(["markAsDone" => $markAsDone, "defaultValue" => $defaultValue]);
    }
}
