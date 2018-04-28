<?php

namespace MadWeb\Seoable\Test;

class SeoableTwitterCardTest extends TestCase
{
    protected $seoTwitterCard;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoTwitterCard = $this->app->make('seotools.twitter');
    }

    /** @test */
    public function filling_meta_tags()
    {
        $this->setUpModel();

        $title = $this->app['translator']->trans(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.twitter_card.title',
            ['title' => $this->testPost->title]
        );

        $description = $this->app['translator']->trans(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.twitter_card.description',
            ['description' => $this->testPost->description]
        );

        $fullHeader = '';
        $fullHeader .= "<meta name=\"twitter:title\" content=\"$title\">";
        $fullHeader .= "<meta name=\"twitter:description\" content=\"$description\">";
        $fullHeader .= "<meta name=\"twitter:url\" content=\"{$this->testPost->url}\">";
        $fullHeader .= "<meta name=\"twitter:site\" content=\"{$this->testPost->site}\">";
        $fullHeader .= "<meta name=\"twitter:card\" content=\"{$this->testPost->type}\">";
        $fullHeader .= "<meta name=\"twitter:foo0\" content=\"{$this->testPost->title}\">";
        $fullHeader .= "<meta name=\"twitter:foo1\" content=\"{$this->testPost->slug}\">";
        $fullHeader .= "<meta name=\"twitter:name\" content=\"{$this->testPost->title}\">";
        $fullHeader .= "<meta name=\"twitter:some\" content=\"{$this->testPost->slug}\">";
        $fullHeader .= "<meta name=\"twitter:images0\" content=\"{$this->testPost->image}\">";
        $fullHeader .= "<meta name=\"twitter:images1\" content=\"{$this->testPost->image}\">";

        $this->setRightAssertion($fullHeader);
    }

    protected function generatedTags()
    {
        return $this->seoTwitterCard->generate(true);
    }

    protected function setUpModel()
    {
        $this->testPost->seoable()
        ->twitter()
            ->setTitle('title')
            ->setDescription('description')
            ->setUrl('url')
            ->setSite('site')
            ->setType('type')
            ->setImages(['image', 'image'])
            ->addValue('foo', ['title', 'slug'])
            ->setValues([
                [
                    'key' => 'name',
                    'value' => 'title',
                ],
                [
                    'key' => 'some',
                    'value' => 'slug',
                ],
            ]);
    }
}
