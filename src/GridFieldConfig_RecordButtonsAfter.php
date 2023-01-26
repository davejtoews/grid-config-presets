<?php

namespace DaveJToews\GridConfigPresets;

use SilverStripe\Forms\GridField\GridField_ActionMenu;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 * Allows editing of records contained within the GridField, instead of only allowing the ability to view records in
 * the GridField.
 */
class GridFieldConfig_RecordButtonsAfter extends GridFieldConfig
{
    /**
     *
     * @param string|null $buttonName - Add Item button label
     * @param GridFieldDataColumns|null $columns
     */
    public function __construct($columns, $buttonName, $sortColumn)
    {
        parent::__construct();

        $this->addComponent(new GridFieldButtonRow('after'));
        $this->addComponent($button = new GridFieldAddNewButton('buttons-after-right'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent($columns ? $columns : new GridFieldDataColumns());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridField_ActionMenu());
        $this->addComponent(new GridFieldDetailForm(null));
        if ($sortColumn) {
            $this->addComponent(new GridFieldOrderableRows($sortColumn));
        }

        if ($buttonName) {
            $button->setButtonName($buttonName);
        }

        $this->extend('updateConfig');
    }
}
