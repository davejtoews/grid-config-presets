<?php

namespace DaveJToews\GridConfigPresets;

use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 *
 */
class GridFieldConfig_ExistingSortable extends GridFieldConfig
{
    /**
     *
     * @param string $sortColumn - Column used by GridFieldOrderableRows
     * @param GridFieldDataColumns|null $columns
     * @param GridFieldAddExistingAutoCompeter|null $autocompleter
     */
    public function __construct($sortColumn = 'Sort', $columns = null, $autocompleter = null)
    {
        parent::__construct();

            $this->addComponent(new GridFieldButtonRow('after'));
            $this->addComponent(new GridFieldToolbarHeader());
            $this->addComponent(new GridFieldTitleHeader());
            $this->addComponent($columns ? $columns : new GridFieldDataColumns());
            $this->addComponent(new GridFieldDeleteAction('unlinkrelation'));
            $this->addComponent(
                $autocompleter
                    ? $autocompleter
                    : new GridFieldAddExistingAutocompleter('buttons-after-right')
            );
            $this->addComponent(new GridFieldOrderableRows($sortColumn));

        $this->extend('updateConfig');
    }
}
