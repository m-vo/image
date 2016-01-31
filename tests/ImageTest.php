<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Test\Image;

use Contao\CoreBundle\Test\TestCase;
use Contao\CoreBundle\Image\Image;
use Contao\CoreBundle\Image\ImageDimensions;
use Contao\CoreBundle\Image\ImportantPart;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * Tests the Image class.
 *
 * @author Martin Auswöger <martin@auswoeger.com>
 */
class ImageTest extends TestCase
{
    /**
     * Create an image instance helper
     *
     * @param ImagineInterface $imagine
     * @param Filesystem       $filesystem
     * @param string           $path
     *
     * @return Image
     */
    private function createImage($imagine = null, $filesystem = null, $path = 'dummy.jpg')
    {
        if (null === $imagine) {
            $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        }

        if (null === $filesystem) {
            $filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');
            $filesystem->method('exists')->willReturn(true);
        }

        return new Image($imagine, $filesystem, $path);
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\\CoreBundle\\Image\\Image', $this->createImage());
    }

    /**
     * Tests the object instantiation with a missing image.
     *
     * @expectedException RuntimeException
     */
    public function testInstantiationMissingFiles()
    {
        $filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');
        $filesystem->method('exists')->willReturn(false);

        $this->createImage(null, $filesystem);
    }

    /**
     * Tests the getPath() method.
     */
    public function testGetPath()
    {
        $image = $this->createImage(null, null, '/path/filename.jpeg');

        $this->assertEquals('/path/filename.jpeg', $image->getPath());
    }

    /**
     * Tests the getDimensions() method.
     */
    public function testGetDimensions()
    {
        $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        $imagineImage = $this->getMock('Imagine\Image\ImageInterface');
        $imagine->method('open')->willReturn($imagineImage);
        $imagineImage->method('getSize')->willReturn(new Box(100, 100));

        $image = $this->createImage($imagine);

        $this->assertEquals(
            new ImageDimensions(new Box(100, 100)),
            $image->getDimensions()
        );
    }

    /**
     * Tests the getImportantPart() method.
     */
    public function testGetImportantPart()
    {
        $imagine = $this->getMock('Imagine\Image\ImagineInterface');
        $imagineImage = $this->getMock('Imagine\Image\ImageInterface');
        $imagine->method('open')->willReturn($imagineImage);
        $imagineImage->method('getSize')->willReturn(new Box(100, 100));

        $image = $this->createImage($imagine);

        $this->assertEquals(
            new ImportantPart(new Point(0, 0), new Box(100, 100)),
            $image->getImportantPart()
        );

        $image->setImportantPart(
            new ImportantPart(new Point(10, 10), new Box(80, 80))
        );

        $this->assertEquals(
            new ImportantPart(new Point(10, 10), new Box(80, 80)),
            $image->getImportantPart()
        );
    }
}