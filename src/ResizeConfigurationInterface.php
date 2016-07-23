<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\Image;

/**
 * Resize configuration used by the ResizeCalculator.
 *
 * @author Martin Auswöger <martin@auswoeger.com>
 */
interface ResizeConfigurationInterface
{
    const MODE_CROP = 'crop';
    const MODE_BOX = 'box';
    const MODE_PROPORTIONAL = 'proportional';

    /**
     * Returns true if the resize would have no effect.
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Gets the width.
     *
     * @return int
     */
    public function getWidth();

    /**
     * Sets the width.
     *
     * @param int $width the width
     *
     * @return self
     */
    public function setWidth($width);

    /**
     * Gets the height.
     *
     * @return int
     */
    public function getHeight();

    /**
     * Sets the height.
     *
     * @param int $height the height
     *
     * @return self
     */
    public function setHeight($height);

    /**
     * Gets the mode.
     *
     * @return string
     */
    public function getMode();

    /**
     * Sets the mode.
     *
     * @param string $mode the mode
     *
     * @return self
     */
    public function setMode($mode);

    /**
     * Gets the zoom level.
     *
     * @return int
     */
    public function getZoomLevel();

    /**
     * Sets the zoom level.
     *
     * @param int $zoomLevel the zoom level
     *
     * @return self
     */
    public function setZoomLevel($zoomLevel);
}