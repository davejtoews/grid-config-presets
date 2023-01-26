<?php

namespace DaveJToews\GridConfigPresets;

use Fromholdio\GridFieldLimiter\Forms\GridFieldLimiter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Config for limited count grildfield with sort column
 */
class GridFieldConfig_LimiterSortable extends GridFieldConfig_RecordButtonsAfter
{
    /**
     *
     * @param integer $limit
     * @param GridFieldDataColumns|null $columns
     * @param string|null $buttonName
     * @param string $sortColumn
     */
    public function __construct($limit = 10, $columns = null, $buttonName = null, $sortColumn = "Sort")
    {
        parent::__construct($columns, $buttonName, $sortColumn);

        $this->addComponent(new GridFieldOrderableRows($sortColumn));
        $this->removeComponentsByType(GridFieldAddNewButton::class);
        $this->addComponent(
            new GridFieldLimiter($limit, 'after', true)
        );
        $this->addComponent($button = new GridFieldAddNewButton('limiter-after-right'));

        if ($buttonName) {
            $button->setButtonName($buttonName);
        }

        $this->extend('updateConfig');
    }
}
