<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Session;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryRequest;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryListResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryResponse;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntriesRequest;
use ste80pa\SuiteCRMClient\Client;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntriesResponse;

/**
 *
 * @author Stefano Pallozzi
 */
abstract class EntryTest extends TestCase
{
    /**
     * @coversNothing
     * @return Client
     * @param Session $session
     */
    abstract protected function initClient(Session $session);
    
    /**
     * @covers ste80pa\SuiteCRMClient\Client::getEntryList
     */
    public function testGetEntryList()
    {
        $session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        $client = $this->initClient($session);
        $client->login();
    
        $request = new GetEntryListRequest();
        $request->module_name = 'Accounts';
        $request->select_fields = array(
            'id',
            'name'
        );
        $request->max_results = 2;
        $request->favorites = false;
        $request->deleted = 0;
        
        $response = $client->getEntryList($request);
        
        $this->assertEquals(get_class($response), GetEntryListResponse::class);
        
        $this->assertObjectHasAttribute('result_count', $response);
        $this->assertObjectHasAttribute('total_count', $response);
        $this->assertObjectHasAttribute('next_offset', $response);
        $this->assertObjectHasAttribute('entry_list', $response);
        
        $this->assertInternalType('integer', $response->result_count);
    //    $this->assertInternalType('integer', intval($response->total_count ));
        $this->assertInternalType('integer', $response->next_offset);
        $this->assertInternalType('array', $response->entry_list);
        
        $this->assertLessThanOrEqual($request->max_results, $response->result_count);
        
        $this->assertCount($response->result_count, $response->entry_list);
        
        foreach ($response->entry_list as $entry) {
            $this->assertEquals($request->module_name, $entry->module_name);
            
            foreach ($request->select_fields as $field) {
                $this->assertObjectHasAttribute($field, $entry);
            }
        }
        
        return $response;
    }
    
    /**
     * @depends testGetEntryList
     * @covers ste80pa\SuiteCRMClient\Client::getEntry
     * @param GetEntryListResponse $response
     */
    public function testGetEntry(GetEntryListResponse $response)
    {
        $session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        $client = $this->initClient($session);
        $client->login();
        
        foreach ($response->entry_list as $entry) {
            $request = new GetEntryRequest();
            $request->id = $entry->id;
            $request->module_name = $entry->module_name;
            $request->select_fields = array(
                'id',
                'name'
            );    
            
            $response = $client->getEntry($request);
            
            $this->assertEquals(get_class($response), GetEntryResponse::class);
            $this->assertCount(1, $response->entry_list);
            
            foreach ($response->entry_list as $entry) {
                $this->assertEquals($request->module_name, $entry->module_name);
                
                foreach ($request->select_fields as $field) {
                    $this->assertObjectHasAttribute($field, $entry);
                }
            }
        }
    }
    
    /**
     * @depends testGetEntryList
     * @covers ste80pa\SuiteCRMClient\Client::getEntries
     * @param GetEntryListResponse $response
     */
    public function testGetEntries(GetEntryListResponse $response)
    {
        $session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        $client = $this->initClient($session);
        $client->login();
        
        $request = new GetEntriesRequest();
        $request->ids = array();
        
        foreach ($response->entry_list as $entry) {
            $request->ids[] = $entry->id;
            $request->module_name = $entry->module_name;
        }
        
        $request->select_fields = array(
            'id',
            'name'
        );
       
        $response = $client->getEntries($request);
        
        $this->assertEquals(get_class($response), GetEntriesResponse::class);
        $this->assertCount(count($request->ids), $response->entry_list);
        
        foreach ($response->entry_list as $entry) {
            
            $this->assertEquals($request->module_name, $entry->module_name);
            $this->assertContains($entry->id, $request->ids);
            
            foreach ($request->select_fields as $field) {
                $this->assertObjectHasAttribute($field, $entry);
            }    
        }        
    }
}