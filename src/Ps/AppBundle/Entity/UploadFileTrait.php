<?php
/**
 * User: nikk
 * Date: 7/29/13
 * Time: 4:02 PM
 */

namespace Ps\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadFileTrait {

    /**
     * @var string
     */
    private $_uploadDirPrefix = 'uploads/';

    /**
     * @var null|string
     */
    private $_uploadDir;

    /**
     * @var string
     */
    private $_prevFilename;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if ( $file !== null ) {
            $filename = &$this->getFilenameField();
            $this->_prevFilename = (string) $filename;
            $filename = $this->_getUniqueFilename();
        }
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Link to the field that is filename
     * @return mixed
     */
    abstract protected function &getFilenameField();

    /**
     * @return string
     * @throws \Exception
     */
    private function _getUniqueFilename()
    {
        // TODO: need investigate does this situation realistic
        for($i = 0; $i < 10; $i++) {
            $filename = $this->_generateUniqueName();
            if ( !$this->_isFileExists($filename) ) {
                return $filename;
            }
        }
        throw new \Exception('Can\'t generate unique name!');
    }

    /**
     * @return string
     */
    private function _generateUniqueName()
    {
        $filename = sha1(uniqid(mt_rand(), true));
        return $filename . '.' . $this->getFile()->guessExtension();
    }

    private function _uploadFile()
    {
        if ( $this->getFile() === null ) {
            return;
        }

        $filename = $this->getFilenameField();

        $this->_removeFile($this->_prevFilename);
        $this->getFile()->move($this->_getUploadRootDir(), $filename);
        $this->file = null;
    }

    /**
     * @param $filename
     */
    private function _removeFile($filename)
    {
        if ( $this->_isFileExists($filename) ) {
            unlink($this->_getAbsolutePath($filename));
        }
    }

    /**
     * @param $filename
     * @return bool
     */
    private function _isFileExists($filename)
    {
        return !empty($filename) && file_exists($this->_getAbsolutePath($filename));
    }

    /**
     * @return string
     */
    private function _getUploadDir()
    {
        if ( $this->_uploadDir === null) {
            return $this->_uploadDirPrefix . strtolower(preg_replace('/.*\\\/', '', get_class($this))) . '/';
        } else {
            return $this->_uploadDirPrefix . $this->_uploadDir;
        }
    }

    /**
     * @return string
     */
    private function _getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->_getUploadDir();
    }

    /**
     * @param $filename
     * @return string
     */
    private function _getAbsolutePath($filename)
    {
        return $this->_getUploadRootDir() . $filename;
    }

    /**
     * @return string
     */
    public function getWebPath()
    {
        if (strlen($this->getFilenameField()) > 0) {
            return $this->_getUploadDir() . $this->getFilenameField();
        } else {
            return 'bundles/psfootball/images/no-photo.jpg';
        }
    }
}