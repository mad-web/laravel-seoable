<?php

namespace MadWeb\Seoable\Test;

use MadWeb\Seoable\Models\SeoData;

class StoredMetaDataTest extends TestCase
{
    protected $seoMeta;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seoMeta = $this->app->make('seotools.metatags');
    }

    protected function generatedTags()
    {
        return $this->seoMeta->generate(true);
    }

    /** @test */
    public function stored_meta()
    {
        $title = 'some title';
        $description = 'some description';

        $this->testPost->seoData->update(['meta' => [
            'title' => $title,
            'description' => $description,
        ]]);

        $this->testPost->seoable()
            ->setTitle('title')
            ->setDescription('description');

        $expectedMeta = '<title>'.$title.' - It\'s Over 9000!</title>';
        $expectedMeta .= "<meta name=\"description\" content=\"$description\">";

        $this->setRightAssertion($expectedMeta);
    }

    /** @test */
    public function ignore_stored_meta()
    {
        $this->testPost->seoData->update(['meta' => [
            'title' => 'some title',
            'description' => 'some description',
        ]]);

        $this->testPost->seoable()
            ->ignoreStored()
            ->setTitle('title')
            ->setDescription('description');

        $title = $this->app['translator']->get(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.title',
            ['title' => $this->testPost->title]
        );

        $description = $this->app['translator']->get(
            'seo.'.\MadWeb\Seoable\Test\Models\Post::class.'.description',
            ['description' => $this->testPost->description]
        );

        $expectedMeta = '<title>'.$title.' - It\'s Over 9000!</title>';
        $expectedMeta .= "<meta name=\"description\" content=\"$description\">";

        $this->setRightAssertion($expectedMeta);
    }

    /** @test */
    public function create_seo_data_in_database()
    {
        $data = ['meta' => [
            'title' => 'some title',
            'description' => 'some description',
        ]];
        $this->testPost->seoData->update($data);

        $this->assertDatabaseHas(
            (new SeoData)->getTable(),
            [
                'seoable_id' => $this->testPost->id,
                'seoable_type' => get_class($this->testPost),
            ] + [
                'meta' => json_encode($data['meta']),
            ]
        );
    }

    /** @test */
    public function cascade_deleting_seo_data()
    {
        $this->testPost->seoData->update(
            [
                'meta' => [
                    'title' => 'some title',
                    'description' => 'some description',
                ],
            ]
        );

        $post_id = $this->testPost->id;
        $post_class_name = get_class($this->testPost);

        $this->testPost->delete();

        $this->assertDatabaseMissing(
            (new SeoData)->getTable(),
            [
                'seoable_id' => $post_id,
                'seoable_type' => $post_class_name,
            ]
        );
    }
}
