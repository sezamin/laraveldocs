<?php

namespace App;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;

class Lesson
{
    /**
     * The filesystem implementation.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem  $files
     * @param  Cache  $cache
     * @return void
     */
    public function __construct(Filesystem $files, Cache $cache)
    {
        $this->files = $files;
        $this->cache = $cache;
    }

    /**
     * Get the documentation index page.
     *
     * @param  string  $version
     * @return string
     */
    public function getIndex($name)
    {
        return $this->cache->remember($name .'.index', 5, function () use ($name) {
            $path = base_path('resources/lessons/' . $name . '/lessons.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks($name, markdown($this->files->get($path)));
            }

            return null;
        });
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $version
     * @param  string  $page
     * @return string
     */
    public function get($name, $page)
    {
        return $this->cache->remember('lessons.'. $name .'.'.$page, 5, function () use ($name, $page) {
            $path = base_path('resources/lessons/'.$name.'/'.$page.'.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks($name, markdown($this->files->get($path)));
            }

            return null;
        });
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $version
     * @param  string  $page
     * @return string
     */
    public function getPage($page)
    {
        return $this->cache->remember('lessons.'.$page, 5, function () use ($page) {
            $path = base_path('resources/lessons/'.$page.'.md');

            if ($this->files->exists($path)) {
                return markdown($this->files->get($path));
            }

            return null;
        });
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks($version, $content)
    {
        return str_replace('{{version}}', $version, $content);
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $version
     * @param  string  $page
     * @return boolean
     */
    public function sectionExists($version, $page)
    {
        return $this->files->exists(
            base_path('resources/lessons/'.$version.'/'.$page.'.md')
        );
    }

    /**
     * Get the publicly available versions of the documentation
     *
     * @return array
     */
    public static function getDocVersions()
    {
        return [
            'php' => 'php',
            'mysql' => 'mysql',
            'laravel' => 'laravel',
        ];
    }
}
