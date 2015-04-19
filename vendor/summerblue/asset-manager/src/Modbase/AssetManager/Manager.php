<?php namespace Modbase\AssetManager;

use \Illuminate\Filesystem\Filesystem as Filesystem;
use \Illuminate\Support\Facades\Config as Config;

class Manager {

    /**
     * Decoded contents of the JSON file
     * 
     * @var array
     */
    protected $data;
    
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    
    /**
     * Create a new manager
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Get HTML for all stylesheets of the bundle
     * 
     * @param  string $bundle
     * @return string
     */
    public function styles($bundle)
    {
        // If we didn't parse the file before, then do it now
        if (!$this->data)
        {
            $this->parseVersionsFile();
        }

        return $this->data[$bundle.'.styles'][0];
    }

    /**
     * Get HTML for all JavaScripts of the bundle
     * 
     * @param  string $bundle
     * @return string
     */
    public function scripts($bundle)
    {
        // If we didn't parse the file before, then do it now
        if (!$this->data)
        {
            $this->parseVersionsFile();
        }

        return $this->data[$bundle.'.scripts'][0];
    }

    /**
     * Get the assets file and contents.
     *
     * @return array
     */
    protected function getVersionsFile()
    {
        return $this->files->get(base_path().'/'.Config::get('asset-manager::config.file'));
    }

    /**
     * JSON decode the assets file
     * 
     * @return array
     */
    protected function parseVersionsFile()
    {
        $this->data = json_decode($this->getVersionsFile(), true);
    }
}
