<?php

namespace MadWeb\Seoable\Test;

class SeoableOpenGraphTestTest extends TestCase
{
    protected $seoOpenGraph;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoOpenGraph = $this->app->make('seotools.opengraph');
    }

    /** @test */
    public function filling_meta_tags()
    {
        $this->setUpModel();

        $title = $this->app['translator']->trans(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.open_graph.title',
            ['title' => $this->testPost->title]
        );

        $description = $this->app['translator']->trans(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.open_graph.description',
            ['description' => $this->testPost->description]
        );

        $fullHeader = '';
        $fullHeader .= "<meta property=\"og:title\" content=\"$title\">";
        $fullHeader .= "<meta property=\"og:description\" content=\"$description\">";
        $fullHeader .= "<meta property=\"og:url\" content=\"{$this->testPost->url}\">";
        $fullHeader .= "<meta property=\"og:site_name\" content=\"{$this->testPost->site}\">";
        $fullHeader .= "<meta property=\"og:name\" content=\"{$this->testPost->title}\">";
        $fullHeader .= "<meta property=\"og:foo\" content=\"{$this->testPost->description}\">";
        $fullHeader .= "<meta property=\"og:bar\" content=\"{$this->testPost->title}\">";
        $fullHeader .= "<meta property=\"og:bar\" content=\"{$this->testPost->slug}\">";
        $fullHeader .= "<meta property=\"og:image\" content=\"{$this->testPost->image}\">";
        $fullHeader .= "<meta property=\"og:image\" content=\"{$this->testPost->image}\">";

        $this->setRightAssertion($fullHeader);
    }

    protected function generatedTags()
    {
        return $this->seoOpenGraph->generate();
    }

    protected function setUpModel()
    {
        $this->testPost->seoable()
        ->opengraph()
            ->setTitle('title')
            ->setDescription(['description'])
            ->setUrl('url')
            ->setSiteName('site')
            ->setImages(['image', 'image'])
            ->setProperties([
                [
                    'key' => 'name',
                    'value' => 'title'
                ],
                [
                    'key' => 'foo',
                    'value' => 'description'
                ]
            ])
            ->addProperty('bar', ['title', 'slug']);
    }
}
