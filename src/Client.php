<?php
namespace ste80pa\SuiteCRMClient;

use ste80pa\SuiteCRMClient\Types\BaseRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetAvailableModulesRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetDocumentRevisionRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntriesCountRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntriesRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetLastViewedRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetModifiedRelationshipsRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetModuleFieldsMd5Request;
use ste80pa\SuiteCRMClient\Types\Requests\GetModuleFieldsRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetNoteAttachmentRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetRelationshipsRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetServerInfoRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetUpcomingActivitiesRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetUserIdRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetUserTeamIdRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LogoutRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SeamlessLoginRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SearchByModuleRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetCampaignMergeRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetDocumentRevisionRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetEntriesRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetEntryRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetNoteAttachmentRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetRelationshipRequest;
use ste80pa\SuiteCRMClient\Types\Requests\SetRelationshipsRequest;
use ste80pa\SuiteCRMClient\Types\Responses\GetAvailableModulesResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetDocumentRevisionResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntriesCountResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntriesResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryListResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetLastViewedResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetModifiedRelationshipsResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetModuleFieldsMd5Response;
use ste80pa\SuiteCRMClient\Types\Responses\GetModuleFieldsResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetNoteAttachmentResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetRelationshipsResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetServerInfoResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetUpcomingActivitiesResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetUserIdResponse;
use ste80pa\SuiteCRMClient\Types\Responses\GetUserTeamIdResponse;
use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;
use ste80pa\SuiteCRMClient\Types\Responses\LogoutResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SeamlessLoginResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SearchByModuleResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetCampaignMergeResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetDocumentRevisionResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetEntriesResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetEntryResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetNoteAttachmentResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetRelationshipResponse;
use ste80pa\SuiteCRMClient\Types\Responses\SetRelationshipsResponse;
/**
 * 
 * @author Stefano Pallozzi
 *
 */
abstract class Client
{
    /**
     *
     * @var array
     */
    protected $session = null;
    
    /**
    * Parameter types (and order) must be the same as what the current wsdl defines.
    *
    * @param string $function
    * @param BaseRequest $request
    * @param string $returnType
    * @throws \Exception
    */
    abstract public function Invoke($function, BaseRequest $request);
    
    /**
     * @param LoginRequest$request
     * @return LoginResponse
     */
    function Login(LoginRequest $request)
    {
        if (file_exists("session.json")) {
            $this->session = json_decode(file_get_contents("session.json"));
            return;
        }
        
        $this->session = $this->Invoke('login', $request);
        file_put_contents("session.json", json_encode($this->session));
        return $this->session;
    }
    /**
     * @param LogoutRequest$request
     * @return LogoutResponse
     */
    function Logout(LogoutRequest $request)
    {
        
        if (file_exists("session.json"))
            unlink("session.json");
            
            return $this->Invoke('logout', $request);
    }
    /**
     * @param GetEntryRequest$request
     * @return GetEntryResponse
     */
    function GetEntry(GetEntryRequest $request)
    {
        return $this->Invoke('get_entry', $request);
    }
    /**
     * @param GetEntriesRequest$request
     * @return GetEntriesResponse
     */
    function GetEntries(GetEntriesRequest $request)
    {
        return $this->Invoke('get_entries', $request);
    }
    /**
     * @param GetEntryListRequest$request
     * @return GetEntryListResponse
     */
    function GetEntryList(GetEntryListRequest $request)
    {
        return $this->Invoke('get_entry_list', $request);
    }
    /**
     * @param SetRelationshipRequest$request
     * @return SetRelationshipResponse
     */
    function SetRelationship(SetRelationshipRequest $request)
    {
        return $this->Invoke('set_relationship', $request);
    }
    /**
     * @param SetRelationshipsRequest$request
     * @return SetRelationshipsResponse
     */
    function SetRelationships(SetRelationshipsRequest $request)
    {
        return $this->Invoke('set_relationships', $request);
    }
    /**
     * @param GetRelationshipsRequest$request
     * @return GetRelationshipsResponse
     */
    function GetRelationships(GetRelationshipsRequest $request)
    {
        return $this->Invoke('get_relationships', $request);
    }
    /**
     * @param SetEntryRequest$request
     * @return SetEntryResponse
     */
    function SetEntry(SetEntryRequest $request)
    {
        return $this->Invoke('set_entry', $request);
    }
    /**
     * @param SetEntriesRequest$request
     * @return SetEntriesResponse
     */
    function SetEntries(SetEntriesRequest $request)
    {
        return $this->Invoke('set_entries', $request);
    }
    /**
     * @param GetServerInfoRequest$request
     * @return GetServerInfoResponse
     */
    function GetServerInfo(GetServerInfoRequest $request)
    {
        return $this->Invoke('get_server_info', $request);
    }
    /**
     * @param GetUserIdRequest$request
     * @return GetUserIdResponse
     */
    function GetUserId(GetUserIdRequest $request)
    {
        return $this->Invoke('get_user_id', $request);
    }
    /**
     * @param GetModuleFieldsRequest$request
     * @return GetModuleFieldsResponse
     */
    function GetModuleFields(GetModuleFieldsRequest $request)
    {
        return $this->Invoke('get_module_fields', $request);
    }
    /**
     * @param SeamlessLoginRequest$request
     * @return SeamlessLoginResponse
     */
    function SeamlessLogin(SeamlessLoginRequest $request)
    {
        return $this->Invoke('seamless_login', $request);
    }
    /**
     * @param SetNoteAttachmentRequest$request
     * @return SetNoteAttachmentResponse
     */
    function SetNoteAttachment(SetNoteAttachmentRequest $request)
    {
        return $this->Invoke('set_note_attachment', $request);
    }
    /**
     * @param GetNoteAttachmentRequest$request
     * @return GetNoteAttachmentResponse
     */
    function GetNoteAttachment(GetNoteAttachmentRequest $request)
    {
        return $this->Invoke('get_note_attachment', $request);
    }
    /**
     * @param SetDocumentRevisionRequest$request
     * @return SetDocumentRevisionResponse
     */
    function SetDocumentRevision(SetDocumentRevisionRequest $request)
    {
        return $this->Invoke('set_document_revision', $request);
    }
    /**
     * @param GetDocumentRevisionRequest$request
     * @return GetDocumentRevisionResponse
     */
    function GetDocumentRevision(GetDocumentRevisionRequest $request)
    {
        return $this->Invoke('get_document_revision', $request);
    }
    /**
     * @param SearchByModuleRequest$request
     * @return SearchByModuleResponse
     */
    function SearchByModule(SearchByModuleRequest $request)
    {
        return $this->Invoke('search_by_module', $request);
    }
    /**
     * @param GetAvailableModulesRequest$request
     * @return GetAvailableModulesResponse
     */
    function GetAvailableModules(GetAvailableModulesRequest $request)
    {
        return $this->Invoke('get_available_modules', $request);
    }
    /**
     * @param GetUserTeamIdRequest$request
     * @return GetUserTeamIdResponse
     */
    function GetUserTeamId(GetUserTeamIdRequest $request)
    {
        return $this->Invoke('get_user_team_id', $request);
    }
    /**
     * @param SetCampaignMergeRequest$request
     * @return SetCampaignMergeResponse
     */
    function SetCampaignMerge(SetCampaignMergeRequest $request)
    {
        return $this->Invoke('set_campaign_merge', $request);
    }
    /**
     * @param GetEntriesCountRequest$request
     * @return GetEntriesCountResponse
     */
    function GetEntriesCount(GetEntriesCountRequest $request)
    {
        return $this->Invoke('get_entries_count', $request);
    }
    /**
     * @param GetModuleFieldsMd5Request$request
     * @return GetModuleFieldsMd5Response
     */
    function GetModuleFieldsMd5(GetModuleFieldsMd5Request $request)
    {
        return $this->Invoke('get_module_fields_md5', $request);
    }
    /**
     * @param GetLastViewedRequest$request
     * @return GetLastViewedResponse
     */
    function GetLastViewed(GetLastViewedRequest $request)
    {
        return $this->Invoke('get_last_viewed', $request);
    }
    /**
     * @param GetUpcomingActivitiesRequest$request
     * @return GetUpcomingActivitiesResponse
     */
    function GetUpcomingActivities(GetUpcomingActivitiesRequest $request)
    {
        return $this->Invoke('get_upcoming_activities', $request);
    }
    /**
     * @param GetModifiedRelationshipsRequest$request
     * @return GetModifiedRelationshipsResponse
     */
    function GetModifiedRelationships(GetModifiedRelationshipsRequest $request)
    {
        return $this->Invoke('get_modified_relationships', $request);
    }
}