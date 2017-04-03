<?php
/**
* script by Przemyslaw Cios version 1.0 beta 1 
 */
include_once('BCGBarcode.php');
include_once('drawer/BCGDrawJPG.php');
include_once('drawer/BCGDrawPNG.php');

class BCGDrawing {
	const IMG_FORMAT_PNG = 1;
	const IMG_FORMAT_JPEG = 2;
	const IMG_FORMAT_GIF = 3;
	const IMG_FORMAT_WBMP = 4;

	private $w, $h;		
	private $color;		
	private $filename;	
	private $im;		
	private $barcode;	
	private $dpi;		
	private $rotateDegree;	


	public function __construct($filename, BCGColor $color) {
		$this->im = null;
		$this->setFilename($filename);
		$this->color = $color;
		$this->dpi = null;
		$this->rotateDegree = 0.0;
	}


	public function __destruct() {
		$this->destroy();
	}


	public function setFilename($filename) {
		$this->filename = $filename;
	}


	private function init() {
		if($this->im === null) {
			$this->im = imagecreatetruecolor($this->w, $this->h)
			or die('Can\'t Initialize the GD Libraty');
			imagefilledrectangle($this->im, 0, 0, $this->w - 1, $this->h - 1, $this->color->allocate($this->im));
		}
	}


	public function get_im() {
		return $this->im;
	}


	public function set_im(&$im) {
		$this->im = $im;
	}


	public function setBarcode(BCGBarcode $barcode) {
		$this->barcode = $barcode;
	}


	public function getDPI() {
		return $this->dpi;
	}


	public function setDPI($dpi) {
		$this->dpi = $dpi;
	}


	public function getRotationAngle() {
		return $this->rotateDegree;
	}

	
	public function setRotationAngle($degree) {
		$this->rotateDegree = (float)$degree;
	}

	
	public function draw() {
		$size = $this->barcode->getMaxSize();
		$this->w = max(1, $size[0]);
		$this->h = max(1, $size[1]);
		$this->init();
		$this->barcode->draw($this->im);
	}


	public function finish($image_style = self::IMG_FORMAT_PNG, $quality = 100) {
		$drawer = null;

		$im = $this->im;
		if($this->rotateDegree > 0.0) {
			$im = imagerotate($this->im, $this->rotateDegree, $this->color->allocate($this->im));
		}

		if ($image_style === self::IMG_FORMAT_PNG) {
			$drawer = new BCGDrawPNG($im);
			$drawer->setFilename($this->filename);
			$drawer->setDPI($this->dpi);
		} elseif ($image_style === self::IMG_FORMAT_JPEG) {
			$drawer = new BCGDrawJPG($im);
			$drawer->setFilename($this->filename);
			$drawer->setDPI($this->dpi);
			$drawer->setQuality($quality);
		} elseif ($image_style === self::IMG_FORMAT_GIF) {
			imagegif($im, $this->filename);
		} elseif ($image_style === self::IMG_FORMAT_WBMP) {
			imagewbmp($im, $this->filename);
		}

		if($drawer !== null) {
			$drawer->draw();
		}
	}


	public function destroy() {
		@imagedestroy($this->im);
	}
};
?>
