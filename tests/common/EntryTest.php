<?php
require_once ('AuthenticatedTest.php');
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryListResponse;

/**
 *
 * @author Stefano Pallozzi
 */
abstract class EntryTest extends AuthenticatedTest
{

    /**
     * @covers ste80pa\SuiteCRMClient\Client::getEntryList
     */
    public function testGetEntiesList()
    {
        $request = new GetEntryListRequest();
        $request->module_name = 'Accounts';
        $request->select_fields = array(
            'id',
            'name'
        );
        $request->max_results = 5;
        $request->favorites = false;
        
        $response = $this->client->getEntryList($request);
        
        $this->assertEquals(get_class($response), GetEntryListResponse::class);
    }
}