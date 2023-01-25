<?php

namespace DaveJToews\GridConfigPresets;

use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Versioned\VersionedGridFieldState\VersionedGridFieldState;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 * Config for an inline editable gridfield, w/ optional sort column
 * and configurable button
 */
class GridFieldConfig_InlineEditable extends GridFieldConfig
{
    /**
     *
     * @param GridFieldDataColumns|null $columns
     * @param GridFieldAddNewInlineButton|null $button
     * @param string|null $sortColumn - Column used by GridFieldOrderableRows no sorting if left blank
     */
    public function __construct($columns, $button, $sortColumn)
    {
        parent::__construct();

        $this->addComponent(new GridFieldButtonRow('after'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent($columns ? $columns : new GridFieldEditableColumns());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent($button ? $button : new GridFieldAddNewInlineButton('buttons-after-right'));
        $this->addComponent(new VersionedGridFieldState());
        if ($sortColumn) {
            $this->addComponent(new GridFieldOrderableRows($sortColumn));
        }

        $this->extend('updateConfig');
    }

    public static function generateButton($name, $position = 'buttons-after-right')
    {
        $button = new GridFieldAddNewInlineButton($position);
        $button->setTitle($name);

        return $button;
    }

    public static function generateColumns($columnArray)
    {
        $columns = new GridFieldEditableColumns();
        $columns->setDisplayFields($columnArray);

        return $columns;
    }
}
