<?php

namespace App\Http\Controllers;

use App\Lesson;
use Symfony\Component\DomCrawler\Crawler;

class LessonController extends Controller
{
    /**
     * The documentation repository.
     *
     * @var Lesson
     */
    protected $docs;

    /**
     * Create a new controller instance.
     *
     * @param  Lesson  $docs
     * @return void
     */
    public function __construct(Lesson $docs)
    {
        $this->docs = $docs;
    }



    /**
     * Show a documentation page.
     *
     * @param  string $version
     * @param  string|null $page
     * @return Response
     */
    public function show($name = null, $page = null)
    {
        if (! $this->isVersion($name)) {
            //return redirect('lessons', 301);
        }

        $sectionPage = $page ?: 'lessons';

        $content = $this->docs->get($name, $sectionPage);


        if (is_null($content)) {
            return response()->view('docs', [
                'title' => 'Page not found',
                'index' => $this->docs->getIndex($name),
                'content' => view('partials.doc-missing'),
                'currentVersion' => $name,
                'versions' => Lesson::getDocVersions(),
                'currentSection' => '',
                'canonical' => null,
            ], 404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        $section = '';

        if ($this->docs->sectionExists($name, $page)) {
            $section .= '/' . $page;
        } elseif (! is_null($page)) {
            return redirect('/lessons/'.$name);
        }

        $canonical = null;

        return view('docs', [
            'title' => count($title) ? $title->text() : null,
            'index' => $this->docs->getIndex($name),
            'content' => $content,
            'currentVersion' => $name,
            'versions' => Lesson::getDocVersions(),
            'currentSection' => $section,
            'canonical' => $canonical,
        ]);
    }

    /**
     * Determine if the given URL segment is a valid version.
     *
     * @param  string  $version
     * @return bool
     */
    protected function isVersion($version)
    {
        return array_key_exists($version, Lesson::getDocVersions());
    }
}
