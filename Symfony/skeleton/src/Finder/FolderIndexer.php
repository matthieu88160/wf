<?php
namespace App\Finder;

use Symfony\Component\Finder\Finder;

class FolderIndexer
{
    const INDEX_FILE = 0b01;
    
    const INDEX_DIR = 0b10;
    
    public function getFolderIndex(string $folderLocation, int $options = self::INDEX_FILE | self::INDEX_DIR) : array {
        $finder = new Finder();
        $finder->in($folderLocation);
        
        $list = [
            'DIR' => [],
            'FILES' => []
        ];
        
        if ($options & self::INDEX_FILE) {
            $list['FILES'] = $this->listFiles($finder);
        }
        if ($options & self::INDEX_DIR) {
            $list['DIR'] = $this->listDir($finder);
        }
        
        return $list;
    }
    
    private function listDir(Finder $finder) : array {
        $dirs = [];
        $findDirs = $finder->directories();
        foreach ($findDirs as $dir) {
            $dirs[] = $dir->getFilename();
        }
        
        return $dirs;
    }
    
    private function listFiles(Finder $finder) : array {
        $files = [];
        $findFiles = $finder->files()->name('/.*/');
        foreach ($findFiles as $file) {
            $files[] = $file->getFilename();
        }
        
        return $files;
    }
}

