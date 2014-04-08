<?php

class ImageExtension extends DataExtension {

    static $showPlaceHolder = false;

    public function PlaceHolder() {

        if ($this->owner->exists()) {
            return $this->owner;
        } else {
            if (self::$showPlaceHolder == true) {
                $ImagePath = "themes/" . Helper::CurrentTheme() . "/images/";
                $ImageName = "ImageNotFound";
                $ImageExt = ".jpg";
                $ImageFilename = $ImagePath . $ImageName . $ImageExt;
                if (!$Image = Image::get()->filter(array("Filename" => $ImageFilename))->First()) {
                    $Image = new Image();
                    $Image->Filename = $ImageFilename;
                    $Image->Title = $ImageName;
                    $Image->write();
                }
                return $Image;
            }
        }
        return false;

    }

    public function PlaceHolder_CSS() {
        if ($this->owner->exists()) {
            return FALSE;
        } else {
            return "ImagePlaceHolder";
        }

    }

    public function MaxWidth($width) {
        if ($this->Width > $width) {
            return $this->setHeight($width);
        } else {
            return $this;
        }

    }

    public function MaxHeight($height) {
        if ($this->Height > $height) {
            return $this->setHeight($height);
        } else {
            return $this;
        }

    }

    public static function set_showPlaceHolder($showPlaceHolder) {
//       self::$showPlaceHolder=$showPlaceHolder;
        if ($showPlaceHolder === (false || 0)) {
            self::$showPlaceHolder = $showPlaceHolder;
        } elseif ($showPlaceHolder === (true || 1)) {
            self::$showPlaceHolder = $showPlaceHolder;
        }

    }

}