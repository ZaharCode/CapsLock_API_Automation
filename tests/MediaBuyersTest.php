<?php

namespace Tests\Unit;

use Codeception\Test\Unit;
use App\Factories\MediaBuyerFactory;
use Codeception\Util\HttpCode;

class MediaBuyersTest extends Unit
{
    private $baseUrl = 'http://localhost/api';
    
    /**
     * Test GET /api/mediabuyers returns HTTP 200 with correct Content-Type header
     */
    public function testGetMediaBuyersReturns200WithCorrectContentType()
    {
        $I = $this->getModule('REST');
        
        // Mock the API response for GET /api/mediabuyers 
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseHeaderContains('Content-Type', 'application/json');
    }
    
    /**
     * Test GET /api/mediabuyers response body conforms to schema
     */
    public function testGetMediaBuyersResponseConformsToSchema()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers data
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseMatchesJsonSchemaFile('schemas/get-media-buyers-schema.json');
    }
    
    /**
     * Test GET /api/mediabuyers data field is always an array (even when empty)
     */
    public function testGetMediaBuyersDataFieldIsAlwaysArray()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        
        // Verify response data is an array
        $response = $I->grabResponse();
        $responseData = json_decode($response, true);
        
        $this->assertArrayHasKey('data', $responseData);
        $this->assertIsArray($responseData['data']);
    }
    
    /**
     * Test GET /api/mediabuyers every item has required fields: id, mbId, initials, name, email, slackUserId, active
     */
    public function testGetMediaBuyersEveryItemHasRequiredFields()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        
        // Get response data for validation
        $response = $I->grabResponse();
        $responseData = json_decode($response, true);
        
        if (isset($responseData['data']) && is_array($responseData['data'])) {
            foreach ($responseData['data'] as $item) {
                $this->assertArrayHasKey('id', $item);
                $this->assertArrayHasKey('mbId', $item);
                $this->assertArrayHasKey('initials', $item);
                $this->assertArrayHasKey('name', $item);
                $this->assertArrayHasKey('email', $item);
                $this->assertArrayHasKey('slackUserId', $item);
                $this->assertArrayHasKey('active', $item);
            }
        }
    }
    
    /**
     * Test GET /api/mediabuyers emails are syntactically valid email addresses
     */
    public function testGetMediaBuyersEmailsAreValid()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        
        // Get response data for validation
        $response = $I->grabResponse();
        $responseData = json_decode($response, true);
        
        if (isset($responseData['data']) && is_array($responseData['data'])) {
            foreach ($responseData['data'] as $item) {
                if (isset($item['email'])) {
                    $this->assertTrue(filter_var($item['email'], FILTER_VALIDATE_EMAIL), 
                        "Invalid email format: {$item['email']}");
                }
            }
        }
    }
    
    /**
     * Test GET /api/mediabuyers active values are 0 or 1 (integers)
     */
    public function testGetMediaBuyersActiveValuesAreIntegers0Or1()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        
        // Get response data for validation
        $response = $I->grabResponse();
        $responseData = json_decode($response, true);
        
        if (isset($responseData['data']) && is_array($responseData['data'])) {
            foreach ($responseData['data'] as $item) {
                if (isset($item['active'])) {
                    $this->assertTrue(in_array($item['active'], [0, 1]), 
                        "Active value must be 0 or 1, got: {$item['active']}");
                }
            }
        }
    }
    
    /**
     * Test GET /api/mediabuyers IDs are unique across the response
     */
    public function testGetMediaBuyersIdsAreUnique()
    {
        $I = $this->getModule('REST');
        
        // Mock API call to get media buyers
        $I->sendGET('/api/mediabuyers');
        $I->seeResponseCodeIs(HttpCode::OK);
        
        // Get response data for validation
        $response = $I->grabResponse();
        $responseData = json_decode($response, true);
        
        if (isset($responseData['data']) && is_array($responseData['data'])) {
            $ids = array_column($responseData['data'], 'id');
            $uniqueIds = array_unique($ids);
            
            // Check that all IDs are unique
            $this->assertEquals(count($ids), count($uniqueIds), 
                "IDs are not unique: " . implode(',', $ids));
        }
    }
    
    /**
     * Test POST /api/mediabuyers with valid data returns 200, correct content-type and schema validation
     */
    public function testPostValidMediaBuyerReturns200WithCorrectContentTypeAndSchema()
    {
        $I = $this->getModule('REST');
        
        // Create a valid media buyer payload
        $validData = MediaBuyerFactory::createValidMediaBuyer();
        
        // Mock API call to POST new media buyer
        $I->sendPOST('/api/mediabuyers', $validData);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseHeaderContains('Content-Type', 'application/json');
        $I->seeResponseMatchesJsonSchemaFile('schemas/post-media-buyer-schema.json');
    }
}