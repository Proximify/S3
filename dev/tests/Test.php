<?php declare(strict_types=1);

require_once('../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Proximify\S3;

class Test extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testBucket = 'uniqueBucketName'; 
        $this->credentials = [
            'key' => 'AWS_KEY',
            'secret' => 'AWS_SECRET'
        ];
    }

    public function testCreateBucket(): void
    {
        S3::init($this->credentials);
        $result = S3::create($this->testBucket);
        $this->assertStringContainsString($this->testBucket, $result);
    }

    public function testListBuckets(): void
    {
        S3::init($this->credentials);
        $result = S3::list($this->testBucket);
        $buckets = $result['Buckets'];
        $this->assertIsArray($buckets);
    }

    public function testPutObject(): void 
    {
        S3::init($this->credentials);
        $result = S3::put($this->testBucket, __DIR__ . '/assets/logo.png');
        $this->assertStringContainsString('logo.png', $result);
    }

    public function testDeleteObject(): void 
    {
        S3::init($this->credentials);
        $result = S3::deleteObject($this->testBucket, __DIR__ . '/assets/logo.png');
        $this->assertStringContainsString('logo.png', $result);
    }

    public function testDeleteBucket(): void
    {
        S3::init($this->credentials);
        $result = S3::delete($this->testBucket);
        $this->assertStringContainsString($this->testBucket, $result);
    }
}