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
use ste80pa\SuiteCRMClient\Types\BaseResponse;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
abstract class Client
{

    /**
     *
     * @var Session
     */
    protected $session = null;

    /**
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     *
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Parameter types (and order) must be the same as what the current wsdl defines.
     *
     * @param string $function
     * @param BaseRequest $request
     * @param BaseResponse $response
     * @throws \Exception
     */
    abstract public function invoke($function, BaseRequest $request, BaseResponse $response);

    /**
     * Logs a user into the Sugar application.
     */
    public function login()
    {
        if ($this->session->usesStorage()) {
            if ($this->session->loadSession()) {
                $valid = $this->seamlessLogin(new SeamlessLoginRequest($this->session->getId()));
                
                if ($valid->return == 1) {
                    return;
                }
                
                $this->session->close();
            }
        }
        
        $request = new LoginRequest($this->session->getUsername(), $this->session->getPassword());
        
        $response = $this->invoke('login', $request,  new LoginResponse());
        
        $this->session->saveSession($response);
    }

    /**
     * Logs a user out of the Sugar application.
     */
    public function logout()
    {
        $this->session->close();
        $this->invoke('logout', new LogoutRequest(), new LogoutResponse());
    }

    /**
     * Retrieves a single bean based on record ID.
     *
     * @param GetEntryRequest $request
     * @return GetEntryResponse
     */
    public function getEntry(GetEntryRequest $request)
    {
        return $this->invoke('get_entry', $request, new GetEntryResponse());
    }

    /**
     * Retrieves a list of beans based on specified record IDs.
     *
     * @param GetEntriesRequest $request
     * @return GetEntriesResponse
     */
    public function getEntries(GetEntriesRequest $request)
    {
        return $this->invoke('get_entries', $request, new GetEntriesResponse());
    }

    /**
     * Retrieves a list of beans based on query specifications.
     *
     * @param GetEntryListRequest $request
     * @return GetEntryListResponse
     */
    public function getEntryList(GetEntryListRequest $request)
    {
        return $this->invoke('get_entry_list', $request, new GetEntryListResponse());
    }

    /**
     * Sets relationships between two records.
     * You can relate multiple records to a single record using this.
     *
     * @param SetRelationshipRequest $request
     * @return SetRelationshipResponse
     */
    public function setRelationship(SetRelationshipRequest $request)
    {
        return $this->invoke('set_relationship', $request, new SetRelationshipResponse());
    }

    /**
     * Sets multiple relationships between multiple record sets.
     * 
     * @param SetRelationshipsRequest $request
     * @return SetRelationshipsResponse
     */
    public function setRelationships(SetRelationshipsRequest $request)
    {
        return $this->invoke('set_relationships', $request, new SetRelationshipsResponse());
    }

    /**
     * Retrieves a specific relationship link for a specified record.
     * 
     * @param GetRelationshipsRequest $request
     * @return GetRelationshipsResponse
     */
    public function getRelationships(GetRelationshipsRequest $request)
    {
        return $this->invoke('get_relationships', $request, new GetRelationshipsResponse());
    }

    /**
     * Creates or updates a specific record.
     * To update an existing record, you will need to specify 'id' in the name_value_list parameter.
     * To create a new record with a specific ID, you will need to set 'new_with_id' in the name_value_list parameter.
     * 
     * @param SetEntryRequest $request
     * @return SetEntryResponse
     */
    public function setEntry(SetEntryRequest $request)
    {
        return $this->invoke('set_entry', $request, new SetEntryResponse());
    }

    /**
     *
     * @param SetEntriesRequest $request
     * @return SetEntriesResponse
     */
    public function setEntries(SetEntriesRequest $request)
    {
        return $this->invoke('set_entries', $request, new SetEntriesResponse());
    }

    /**
     *
     * @param GetServerInfoRequest $request
     * @return GetServerInfoResponse
     */
    public function setServerInfo(GetServerInfoRequest $request)
    {
        return $this->invoke('get_server_info', $request, new GetServerInfoResponse());
    }

    /**
     *
     * @param GetUserIdRequest $request
     * @return GetUserIdResponse
     */
    public function getUserId(GetUserIdRequest $request)
    {
        return $this->invoke('get_user_id', $request, new GetUserIdResponse());
    }

    /**
     *
     * @param GetModuleFieldsRequest $request
     * @return GetModuleFieldsResponse
     */
    public function getModuleFields(GetModuleFieldsRequest $request)
    {
        return $this->invoke('get_module_fields', $request, new GetModuleFieldsResponse());
    }

    /**
     * Verifies that a session is authenticated.
     *
     * @param SeamlessLoginRequest $request
     * @return SeamlessLoginResponse
     */
    public function seamlessLogin(SeamlessLoginRequest $request)
    {
        return $this->invoke('seamless_login', $request, new SeamlessLoginResponse());
    }

    /**
     *
     * @param SetNoteAttachmentRequest $request
     * @return SetNoteAttachmentResponse
     */
    public function setNoteAttachment(SetNoteAttachmentRequest $request)
    {
        return $this->invoke('set_note_attachment', $request, new SetNoteAttachmentResponse());
    }

    /**
     *
     * @param GetNoteAttachmentRequest $request
     * @return GetNoteAttachmentResponse
     */
    public function getNoteAttachment(GetNoteAttachmentRequest $request)
    {
        return $this->invoke('get_note_attachment', $request, new GetNoteAttachmentResponse());
    }

    /**
     *
     * @param SetDocumentRevisionRequest $request
     * @return SetDocumentRevisionResponse
     */
    public function setDocumentRevision(SetDocumentRevisionRequest $request)
    {
        return $this->invoke('set_document_revision', $request, new SetDocumentRevisionResponse());
    }

    /**
     *
     * @param GetDocumentRevisionRequest $request
     * @return GetDocumentRevisionResponse
     */
    public function getDocumentRevision(GetDocumentRevisionRequest $request)
    {
        return $this->invoke('get_document_revision', $request, new GetDocumentRevisionResponse());
    }

    /**
     *
     * @param SearchByModuleRequest $request
     * @return SearchByModuleResponse
     */
    public function searchByModule(SearchByModuleRequest $request)
    {
        return $this->invoke('search_by_module', $request, new SearchByModuleResponse());
    }

    /**
     *
     * @param
     *            GetAvailableModulesRequest$request
     * @return GetAvailableModulesResponse
     */
    public function getAvailableModules(GetAvailableModulesRequest $request)
    {
        return $this->invoke('get_available_modules', $request, new GetAvailableModulesResponse());
    }

    /**
     *
     * @param GetUserTeamIdRequest $request
     * @return GetUserTeamIdResponse
     */
    public function getUserTeamId(GetUserTeamIdRequest $request)
    {
        return $this->invoke('get_user_team_id', $request, new GetUserTeamIdResponse());
    }

    /**
     *
     * @param SetCampaignMergeRequest $request
     * @return SetCampaignMergeResponse
     */
    public function setCampaignMerge(SetCampaignMergeRequest $request)
    {
        return $this->invoke('set_campaign_merge', $request, new SetCampaignMergeResponse());
    }

    /**
     * Retrieves a list of beans based on query specifications.
     *
     * @param GetEntriesCountRequest $request
     * @return GetEntriesCountResponse
     */
    public function getEntriesCount(GetEntriesCountRequest $request)
    {
        return $this->invoke('get_entries_count', $request, new GetEntriesCountResponse());
    }

    /**
     *
     * @param GetModuleFieldsMd5Request $request
     * @return GetModuleFieldsMd5Response
     */
    public function getModuleFieldsMd5(GetModuleFieldsMd5Request $request)
    {
        return $this->invoke('get_module_fields_md5', $request, new GetModuleFieldsMd5Response());
    }

    /**
     *
     * @param GetLastViewedRequest $request
     * @return GetLastViewedResponse
     */
    public function getLastViewed(GetLastViewedRequest $request)
    {
        return $this->invoke('get_last_viewed', $request, new GetLastViewedResponse());
    }

    /**
     *
     * @param GetUpcomingActivitiesRequest $request
     * @return GetUpcomingActivitiesResponse
     */
    public function getUpcomingActivities(GetUpcomingActivitiesRequest $request)
    {
        return $this->invoke('get_upcoming_activities', $request, new GetUpcomingActivitiesResponse());
    }

    /**
     *
     * @param GetModifiedRelationshipsRequest $request
     * @return GetModifiedRelationshipsResponse
     */
    public function getModifiedRelationships(GetModifiedRelationshipsRequest $request)
    {
        return $this->invoke('get_modified_relationships', $request, new GetModifiedRelationshipsResponse());
    }
}