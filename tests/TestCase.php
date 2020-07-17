<?php

namespace MadWeb\Seoable\Test;

use Illuminate\Database\Schema\Blueprint;
use MadWeb\Seoable\Test\Models\Post;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /** @var Post */
    protected $testPost;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('seoable.templates_path', 'seo');

        $this->setUpDatabase($this->app);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \MadWeb\Seoable\SeoableServiceProvider::class,
            \MadWeb\Seoable\Test\TestServiceProvider::class,
        ];
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('image');
        });
        include_once __DIR__.'/../database/migrations/create_seo_table.php.stub';

        (new \CreateSeoTable())->up();

        $this->testPost = Post::create([
            'title' => 'Post title',
            'slug' => 'post-slug',
            'description' => 'Post description',
            'image' => 'http://seoable.url/image.jpg',
        ]);
    }

    /**
     * @param $string
     * @return \DOMDocument
     */
    protected function makeDomDocument($string)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($string);

        return $dom;
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom = $this->makeDomDocument($this->generatedTags());

        $this->assertEquals($expectedDom->C14N(), $actualDom->C14N());
    }

    /**
     * @return mixed
     */
    protected function generatedTags()
    {
        return '';
    }
}
